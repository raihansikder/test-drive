<?php

namespace App\Mainframe\Modules\Uploads\Traits;

use Str;
use Storage;
use App\Upload;

/** @mixin \App\Mainframe\Modules\Uploads\UploadController $this */
trait CanUploadTrait
{

    /** @var null|array|bool|\Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[] */
    public $file;

    /** @var string */
    public $fileField = 'file_field';

    /*
    |--------------------------------------------------------------------------
    | Section: Upload related functions
    |--------------------------------------------------------------------------
    */

    /**
     * Get the uploaded file from request
     *
     * @return null|array|bool|\Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getFile()
    {
        if ($this->file) {
            return $this->file;
        }

        $this->file = request()->file($this->fileField()); // null if no file is found

        return $this->file;
    }

    /**
     * Get the input request field name for the file
     *
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function fileField()
    {
        return request()->get($this->fileField, 'file');
    }

    /**
     * Physically move the file to a location.
     *
     * @return bool|string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function attemptUpload()
    {
        # Check if file object exists
        if (!$this->file = $this->getFile()) {
            $this->fail('No file in http request');
            return false;
        }

        # Run some validation ?


        # Fill data
        // Keep the original file name
        $this->setOriginalFileName();

        $path = $this->attemptStorageUpload(); // Upload to storage/app
        // return $this->attemptLocalUpload(); // Upload to another public directory i.e. files
        // return $this->attemptAwsUpload();   // Upload in AWS

        if (!$path) {
            $this->fail('Could not move file to destination directory');
            return false;
        }

        return $path;

    }

    /**
     * Set the original file name in uploads
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function setOriginalFileName()
    {
        $this->element->name = pathinfo($this->getFile()->getClientOriginalName(), PATHINFO_FILENAME);
        return $this;
    }

    /**
     * Upload in the same local server public directory with direct URL to file
     *
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function attemptLocalUpload()
    {
        $path = $this->localRelativePath();

        if ($this->file->move($this->uploadDirectory(), $path)) {
            return $path; // Relative to public
        }
    }

    /**
     * Upload in the storage/app directory
     *
     * @return string|bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function attemptStorageUpload()
    {
        return $this->getFile()->storeAs($this->uploadDirectory(), $this->uniqueFileName()); // Relative to storage/app
    }

    /**
     * Upload in AWS
     *
     * @return string|void
     */
    public function attemptAwsUpload()
    {
        if ($awsPath = Storage::disk('s3')->putFile(env('APP_ENV'), $this->file, 'public')) {
            return Storage::disk('s3')->url($awsPath); // AWS URL to file
        }
    }

    /**
     * Upload root directory. Can be located in public or storage based on where
     * the file is uploaded in the project
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function rootDirectory()
    {
        return request('bucket') ?: trim(config('mainframe.config.upload_root'), "\\/ ");
    }

    /**
     * Relative path to local directory inside public
     * Upload location: public/{upload_root}/{tenant_id}/YYYY/mm/dd/HH/ii
     *                  public/files        /1          /2021/12/25/23/59
     * For uploads where there is no tenant the default tenant_id=0
     *
     * @return string
     */
    public function uploadDirectory()
    {
        // If the file is already uploaded the use the same director to upload the updated file
        if ($path = optional($this->element)->path) {
            return dirname($path);
        }

        // Else, derive the upload directory
        $root = $this->rootDirectory();

        $tenantId = '0';
        if ($uploadable = $this->element->uploadable) {
            $tenantId = $uploadable->tenant_id ?? $tenantId;
        } elseif (isset($this->tenant_id)) {
            $tenantId = $this->tenant_id;
        }

        return Upload::directoryTree($root, $tenantId);
    }

    /**
     * Relative file path
     *
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function localRelativePath()
    {
        return '/'.trim($this->uploadDirectory(), '/').'/'.$this->uniqueFileName();
    }

    /**
     * Generate unique file name by adding a random string in the beginning.
     * This also sanitizes the name and resolves any issue that might arise from users uploading
     * files that has incompatible characters.
     *
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function uniqueFileName()
    {
        //$originalNamePart = pathinfo($this->getFile()->getClientOriginalName(), PATHINFO_FILENAME);
        $namePart = Str::random(8).'_'.now()->format('YmdHis');
        $ext = $this->getFile()->getClientOriginalExtension();

        return $namePart.'.'.$ext;
    }

    /**
     * Get dimension of image
     *
     * @return array|bool
     */
    public function getImageDimension()
    {
        if (isImageExtension($this->file->getClientOriginalExtension())) {
            [$width, $height] = getimagesize($this->file->getPathname());

            return ['width' => $width, 'height' => $height];
        }

        return false;
    }

    /**
     * Check if file is image
     *
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function fileIsImage()
    {
        // $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];

        if (Str::contains($this->getFile()->getMimeType(), 'image/')) {
            return true;
        }

        return false;

    }

}
