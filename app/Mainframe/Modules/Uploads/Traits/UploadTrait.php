<?php

namespace App\Mainframe\Modules\Uploads\Traits;

use Str;
use File;
use Storage;
use Exception;
use App\Upload;
use App\Mainframe\Features\PDFMerger\PDFMerger;
use App\Project\Features\Modular\BaseModule\BaseModule;

/** @mixin Upload|\App\Upload */
trait UploadTrait
{
    /**
     * get all uploads under a module
     *
     * @param  array  $entry_uuid
     * @param  string  $filter
     * @return mixed
     */
    public static function getList($entry_uuid, $filter = '')
    {
        $uploads = Upload::where('element_uuid', $entry_uuid);

        return $uploads->orderBy('created_at', 'DESC')->get();
    }

    /**
     * During creation of a module entry there is no id but
     * still files can be uploaded.
     *
     * @param $element BaseModule
     */
    public static function linkTemporaryUploads($element)
    {
        if (!$element->uuid) {
            return;
        }

        $uploads = Upload::where('element_uuid', $element->uuid)
            ->whereNull('element_id')
            ->whereNull('uploadable_id')
            ->get();

        foreach ($uploads as $upload) {
            $upload->element_id = $element->id;
            $upload->uploadable_id = $element->id;
            $upload->fillModuleAndElement('uploadable');
            $upload->saveQuietly();
        }
    }

    /**
     * The file can be stored under public/* or storage/*. Previously we stored files in public
     * The function determines where the file actually is.
     *
     * @return string
     */
    public function absPath()
    {
        if (Storage::exists($this->path)) {
            return Storage::path($this->path);
        }

        if (File::exists(public_path($this->path))) {
            return public_path($this->path);
        }

        return null;
    }

    /**
     * Get the url for thumbnail of an upload.
     *
     * @return string
     */
    public function thumbnail()
    {
        if ($this->isImage()) {
            return $this->url;
        }
        return $this->extIconPath();
    }

    /**
     * Checks if an upload file is image
     *
     * @return mixed
     */
    public function isImage()
    {
        if (isImageExtension($this->ext)) {
            return true;
        }

        # Alternatively

        if ($this->file() && Str::contains($this->file()->getMimeType(), 'image/')) {
            return true;
        }

        return false;
    }

    /**
     * Checks if an upload file is image
     *
     * @return mixed
     */
    public function isPdf()
    {
        if (Str::lower($this->ext) == 'pdf') {
            return true;
        }

        return false;
    }

    public function isPublic()
    {
        return Str::startsWith(trim($this->path, '/'), 'public');
    }

    /**
     * 'file_type_icons' contains number of file type icons.
     *
     * @return string
     */
    public function extIconPath()
    {
        $ext = strtolower($this->ext); // get full lower case extension
        $icon_path = 'mainframe/images/file_type_icons/'.$ext.'.png';

        if (!File::exists($icon_path)) {
            $icon_path = 'mainframe/images/file_type_icons/noimage.png';
        }

        return asset($icon_path);
    }

    /**
     * Generate masked and plain url of the uploaded file.
     *
     * @param  bool  $auth  set false to generate plain url.
     * @return string
     */
    public function downloadUrl()
    {
        return route('download', $this->uuid);
    }

    /**
     * Fill extension
     *
     * @return $this
     */
    public function fillExtension()
    {
        $this->ext = extFrmPath($this->path); // Store file extension separately

        return $this;
    }

    public function fileName()
    {
        return basename($this->path);
    }

    public function fileNameWithoutExt()
    {
        return basename($this->path, '.'.$this->ext);
    }

    public function directory()
    {
        $path_parts = pathinfo($this->path);

        return $path_parts['dirname'] ?? null;
    }

    public function relativePath()
    {
        return trim($this->path, '/\\');
    }

    /**
     * Rename with full name and extension
     *
     * @param  string  $newNameWithExt  some-file.mp3
     * @return bool
     */
    public function rename($newNameWithExt)
    {
        $newPath = $this->directory().Str::start($newNameWithExt, '/');
        File::move(trim($this->path, '/\\'), trim($newPath, '/\\'));

        return $this->update(['path' => $newPath]);
    }

    /**
     * Rename only name part
     *
     * @param  string  $newName  some-file-name-without-ext
     * @return bool
     */
    public function renameName($newName)
    {
        $newNameWithExt = $newName.Str::start($this->ext, '.'); // Add extension

        return $this->rename($newNameWithExt);
    }

    // /**
    //  * Copy an upload to destination directory.
    //  * Todo: public_path() seems hard coded
    //  *
    //  * @param $to
    //  * @return bool
    //  */
    // public function copy($to)
    // {
    //     $from = trim($this->path, '/\\');
    //     if (!\File::exists($from)) {
    //         return false;
    //     }
    //
    //     $to = trim($to, '/\\');
    //     $path_parts = pathinfo($to);
    //     $toDirectory = $path_parts['dirname'];
    //
    //     \File::makeDirectory(public_path().'/'.$toDirectory, 0777, true, true);
    //
    //     return \File::copy($from, $to);
    // }

    /**
     * Copy file to a different location of storage
     *
     * @param $to
     * @return bool
     */
    public function copy($to)
    {
        if (!$this->fileExists()) {
            return false;
        }

        $to = trim($to, ' \/');

        // Path given a directory without full file name and extension
        if (!Str::contains($to, '.'.$this->ext)) {
            $to .= '/'.$this->fileName();
        }

        if ($to == $this->path) { // Same destination. No action required
            return false;
        }

        if (Storage::copy($this->path, $to)) {
            $this->update(['path' => $to]);
        }

        return true;
    }

    /**
     * Move file to a different location of storage
     *
     * @param $to
     * @return bool
     */
    public function move($to)
    {
        if (!$this->fileExists()) {
            return false;
        }

        $to = trim($to, ' \/');

        // Path given a directory without full file name and extension
        if (!Str::contains($to, '.'.$this->ext)) {
            $to .= '/'.$this->fileName();
        }

        if ($to == $this->path) { // Same destination. No action required
            return false;
        }

        if (Storage::move($this->path, $to)) {
            $this->update(['path' => $to]);
        }

        return true;
    }

    /**
     * Check if upload exists
     *
     * @return bool
     */
    public function fileExists()
    {
        return Storage::exists($this->path);
    }

    /**
     * Get the file object
     *
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function file()
    {
        if (!$this->absPath()) {
            return null;
        }
        return new \Symfony\Component\HttpFoundation\File\File($this->absPath());
    }

    /**
     * Fill fileinfo like name, ext, size
     *
     * @return $this
     */
    public function fillFileInfo()
    {
        if (!$this->absPath()) {
            return $this;
        }

        try {
            $file = $this->file();
            $this->name = $this->name ?: $file->getFilename();
            $this->ext = $file->getExtension();
            $this->bytes = $file->getSize();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        return $this;
    }

    /**
     * Date based directory tree to store file.
     * The path is relative to storage folder
     *
     * @param  null|string  $bucket  root directory
     * @param  null|int  $tenantId
     * @return string
     */
    public static function directoryTree($bucket = null, $tenantId = null)
    {
        $bucket = $bucket ?: trim(config('mainframe.config.upload_root'), "\\/ ");
        $tenantId = $tenantId ?: '0'; // 0= Non-tenant

        $parts = [];

        $parts[] = $bucket;                         // public
        $parts[] = $tenantId;                       // 0

        $time = now();
        $parts[] = $time->format('Y');       // 2023
        $parts[] = $time->format('m');       // 12
        $parts[] = $time->format('d');       // 31
        $parts[] = $time->format('H');       // 18
        $parts[] = $time->format('i');       // 59

        return implode('/', $parts);       // public/{tenantId}/2023/12/31/18/59
    }

    /**
     * Check if the upload is a single upload.
     *
     * @return bool
     */
    public function isSingleUpload()
    {
        if (property_exists(Upload::class, 'typesWithSingleImage')) {
            return in_array($this->type,
                Upload::$typesWithSingleImage); // MF6 - Older MF version had this variable. This logic is retained for backward compatibility.
        }
        if (property_exists(Upload::class, 'typesWithSingleUpload')) {
            /** @noinspection PhpUndefinedFieldInspection */
            return in_array($this->type, Upload::$typesWithSingleUpload); // MF9+
        }

        return false;
    }

    /**
     * Merge multiple pdf files (abs path)
     *
     * @throws \exception
     */
    public static function mergePdf($files, $destination)
    {
        require_once(base_path('app/Mainframe/Features/PDFMerger/PDFMerger.php'));
        $pdf = new PDFMerger();

        $hasPdf = false;
        try {
            foreach ($files as $file) {
                if (\Str::endsWith(strtolower($file), '.pdf')) {
                    // $this->addMessage($file);
                    $pdf->addPDF($file);
                    $hasPdf = true;
                }
            }
        } catch (\Exception $e) {
            message($e->getMessage().'Merging of some PDF failed. Try uploading jpg image instead');
        }
        if (!$hasPdf) { // No files to merge
            return;
        }

        if (!File::isDirectory(dirname($destination))) {
            File::makeDirectory(dirname($destination));
        }
        $pdf->merge('file', $destination);

        return $destination;
    }

    /**
     * Move an existing upload under element
     *
     * @param  BaseModule|mixed  $element
     * @return \App\Upload|mixed
     */
    public function changeParentElement($element)
    {
        $this->uploadable_type = $element->rootModel();
        $this->uploadable_id = $element->id;
        $this->module_id = $element->module()->id;
        $this->element_id = $element->id;
        $this->element_uuid = $element->uuid;
        $this->saveQuietly();

        return $this;
    }


    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * Creates a URL to a file
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        $fallback = asset('mainframe/images/noimage.png');

        if (!$this->path) {
            return $fallback;
        }
        // First check if file exists in storage/app/files
        if (Storage::exists($this->path)) {
            // 1- Check if storage is public. If public share the public URL
            if ($this->isPublic()) {
                return url(Storage::url($this->path));
            }

            // No! no direct access
            if ($this->isImage()) {
                return route('show.image', $this->id);
            }

            return $this->downloadUrl();
        }

        // Check if file exists in public/files
        if (File::exists(public_path($this->path))) {
            return asset($this->path);
        }

        return $fallback;
    }

    /**
     * Directory
     *
     * @return string
     */
    public function getDirAttribute()
    {
        return Storage::path($this->path);
    }

    /**
     * Name for the file to download
     *
     * @return string
     */
    public function getDownloadNameAttribute()
    {
        return trim(strtoupper($this->type).'-'.$this->id.'-'.$this->name, '-');
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */
    public function uploadable()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Todo: Helper functions
    |--------------------------------------------------------------------------
    | Todo: Write Helper functions in the UploadHelper trait.
    */

    /**
     * Deletes the previously uploaded file of the same type.
     * This function is useful for uploading profile pic
     * where there the latest pic will discard the last one.
     */
    public function deletePreviousOfSameType()
    {
        if (isset($this->uploadable)) {
            $this->uploadable->uploads()
                ->where('type', $this->type)
                ->where('id', '!=', $this->id)
                ->delete();
        }
    }

    /**
     * Delete the physical file at given file path
     *
     * @param $path
     * @return bool
     */
    public static function deleteFilePath($path)
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        if (File::exists(public_path($path))) {
            return File::delete($path);
        }

        return false;
    }
}
