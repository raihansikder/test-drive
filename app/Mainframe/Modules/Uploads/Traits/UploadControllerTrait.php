<?php

namespace App\Mainframe\Modules\Uploads\Traits;

use Str;
use File;
use Storage;
use Response;
use App\Upload;
use ZipArchive;
use App\Module;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/** @mixin \App\Mainframe\Modules\Uploads\UploadController $this */
trait UploadControllerTrait
{

    use CanUploadTrait;

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    */
    // public function datatable() { }
    // public function listJson() { }
    // public function report() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Laravel rule-based validator that is called during store.
     * This only validates the request. For upload, the file
     * type validation has to be done in the request level
     * before moving on to processor level.
     *
     * @return \Illuminate\Validation\Validator
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function storeRequestValidator()
    {
        $field = $this->fileField(); // Form input field name for the file upload

        $rules = [
            $field => [
                'file',
                'required',
                'mimes:jpeg,png,pdf',
                'max:'.(2 * 1024), // 2 MB
                // \Illuminate\Validation\Rules\File::types(['jpg', 'jpeg', 'png'])->max(2 * 1024), // Laravel 9+
            ],
        ];

        $customValidationMessage = [
            // 'field.rule' => "Custom validation message",
        ];

        return Validator::make(request()->all(), $rules, $customValidationMessage);
    }
    // public function updateRequestValidator() { }
    // public function saveRequestValidator() { }
    // public function attemptStore() { }
    // public function attemptUpdate() { }
    // public function attemptDestroy() { }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function store(Request $request)
    {
        if (!user()->can('create', $this->model)) {
            return $this->permissionDenied();
        }

        $this->element = $this->model; // Create an empty model to be stored.

        $this->element->type = $request->get('upload_type'); // for avoiding generic type field conflict

        if (!$this->element->path = $this->attemptUpload()) {
            return $this->fail('The file could not be uploaded')->send();
        }

        $this->attemptStore();

        if (!$this->isValid()) {
            $this->element = null;
        }

        return $this->load($this->element)->send();
    }
    // public function stored() { }
    // public function updated() { }
    // public function saved() { }
    // public function deleted() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Custom Controller functions
    |--------------------------------------------------------------------------
    */

    /**
     * Downloads the file with HTTP response to hide the file url
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\StreamedResponse|void
     */

    public function download($uuid)
    {
        clean_output_buffer();
        $upload = Upload::where('uuid', $uuid)
            ->remember(timer('long'))
            ->first();

        if (!$upload) {
            return $this->notFound();
        }

        // Download from /storage/app..
        if (Storage::exists($upload->path)) {
            return Storage::download($upload->path);
        }

        // Download from /public/...
        $path = public_path().Str::start($upload->path, '/');
        if (File::exists($path)) {
            return Response::download($path);
        }

        abort(404);
    }

    /**
     * Reorder JobUnits/Paragraphs with in paragraphs.
     * IDs are sent as an array job_unit_ids
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function reorder(Request $request)
    {
        $ids = \request('ids');
        $i = 1;
        foreach ($ids as $id) {
            Upload::where('id', $id)->update(['order' => $i++]);
        }

        return $this->load(['ids' => $ids])->success('Upload order has been updated')->json();
    }

    /**
     * Show images or other types of uploads from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @depricated use showUpload
     */
    public function showImage($id)
    {
        return $this->showUpload($id);
    }

    /**
     * Show images or other types of uploads from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function showUpload($id)
    {
        $upload = Upload::findOrFail($id);

        $path = $upload->path;

        if (!Storage::exists($path)) {
            abort(404);
        }
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        clean_output_buffer();

        return $response;
    }

    /**
     * Update
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function updateExistingUpload()
    {
        if (!user()->can('update', $this->model)) {
            return $this->permissionDenied();
        }

        if (!$this->file = $this->getFile()) {
            return $this->fail('No file in http request')->send();
        }

        if (!$id = \request('upload_id')) {
            return $this->fail('No upload id found')->send();
        }

        $this->element = Upload::findOrFail($id); // Create an empty model to be stored.
        $upload = $this->element;
        $oldFilePath = $upload->path; // Store old file path before it gets overwritten

        if (!$path = $this->attemptUpload()) {
            return $this->fail('Can not move file to destination from tmp')->send();
        }
        $upload->path = $path;

        $this->attemptStore();

        if (!$this->isValid()) {
            $upload = null;
        } else {
            Upload::deleteFilePath($oldFilePath); // Delete the physical file
        }

        return $this->load($upload)->send();
    }

    /**
     * Download files as zip
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function downloadZip()
    {
        // Step 1- Get the uploads
        $uploads = $this->getUploadsForZip();
        if (!count($uploads)) {
            abort('No files to zip');
        }

        // Step 2- Define the zip file name
        $fileName = \request('zip_file_name') ?: Str::random(8).'-'.time();
        if (!Str::endsWith($fileName, '.zip')) {
            $fileName .= '.zip';
        }

        // Step 3- Define the location where the zip will be created. This should be a temporary directory that is cleaned periodically
        $tempPath = '/temp/'.$fileName; // The zip will be created in this location
        $zip = new ZipArchive;

        // Step 4- Create the package
        if (true === ($zip->open(public_path($tempPath), ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
            $count = 0;
            foreach ($uploads as $upload) {
                if ($upload->absPath()) {
                    $zip->addFile($upload->absPath(), $upload->download_name);
                    $count++;
                }
            }
            $zip->close();

            // Step 5- Download response
            clean_output_buffer();

            return response()->download(public_path($tempPath));
        }
        abort(400, 'Could not create the zip package');
    }

    /**
     * Get Uploads under an element using element_uuid.
     *
     * @return \App\Project\Features\Modular\BaseModule\BaseModule[]|\App\Upload[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|null
     */
    public function getUploadsOfElement()
    {
        if (!$elementUuid = \request('element_uuid')) {
            abort(400, 'Element not found');
        }

        $query = Upload::active()->where('element_uuid', $elementUuid);

        if ($type = \request('type')) {
            $query->whereIn('type', Arr::wrap($type));
        }

        return $query->limit(50)->get();
    }

    /**
     * Get Uploads under an element using module_id, element_id
     *
     * @return \App\Project\Features\Modular\BaseModule\BaseModule[]|\App\Upload[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|null
     */
    public function getUploadsOfElementByModuleId()
    {
        $moduleId = \request('module_id');
        $elementId = \request('element_id');

        if (!$moduleId || !$elementId) {
            abort(400, 'Module and element id not valid');
        }

        $query = Upload::active()
            ->where('module_id', $moduleId)
            ->where('element_id', $elementId);

        if ($type = \request('type')) {
            $query->whereIn('type', Arr::wrap($type));
        }

        return $query->limit(50)->get();
    }

    /**
     * Get the uploads that will be packed for zip
     *
     * @return \App\Upload[]|null
     */
    public function getUploadsForZip()
    {
        return $this->getUploadsOfElement();
    }

    /**
     * Fill module_id from module='module-name' URL param
     *
     * @return $this
     */
    public function fill()
    {
        // Resolve module from name
        if ($val = request('module')) {
            $this->element->module_id = optional(Module::byName($val))->id;
        }

        return parent::fill();
    }
}
