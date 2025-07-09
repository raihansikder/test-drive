<?php

namespace App\Mainframe\Features\Form;

use Illuminate\Support\Str;

class Upload extends Input
{
    /**
     * Main div container css
     *
     * @var string
     */
    public $containerClass;
    /**
     * Module id
     *
     * @var null|mixed
     */
    public $moduleId;
    /**
     * Element id
     *
     * @var null|mixed
     */
    public $elementId;
    /**
     * Element uuid
     *
     * @var null|mixed
     */
    public $elementUuid;
    /**
     * The type of upload defined as ... Upload::TYPE
     *
     * @var null|mixed
     */
    public $type;
    /**
     * Limits/Counts of uploaded files to be shown
     *
     * @var int
     */
    public $limit;
    /**
     * Tenant id
     *
     * @var null|int
     */
    public $tenantId;
    /**
     * Upload box id. Useful for JS targetting.
     *
     * @var string
     */
    public $uploadBoxId;
    /**
     * Polymorphic type
     *
     * @var string
     */
    public $uploadableType;
    /**
     * Upload POST url
     *
     * @var string
     */
    public $postUrl;
    /**
     * Bucket/Directory in storage. For public use 'public'
     *
     * @var string
     */
    public $bucket;
    /**
     * Show zip download option
     *
     * @var string
     */
    public $zipDownload = false;
    /**
     * Show list
     *
     * @var bool
     */
    public $showList = true;
    /**
     * A JS function to call for upload
     *
     * @var mixed|string
     */
    public $uploaderFunction;
    /**
     * Badge CSS
     *
     * @var string
     */
    public $badge;
    /**
     * Enable/Disable sorting
     *
     * @var bool|mixed
     */
    public $sort;

    /**
     * Show/Hide delete button
     *
     * @var bool|mixed
     */
    public $deleteBtn;

    /**
     * Show link to upload details
     *
     * @var bool|mixed
     */
    public $detailLink;

    /**
     * Show preview
     *
     * @var bool|mixed
     */
    public $preview;
    /**
     * File card class
     *
     * @var bool|mixed
     */
    public $cardCss;

    /**
     * Input constructor.
     *
     * @param  \App\Mainframe\Features\Modular\BaseModule\BaseModule  $element
     * @param  array  $var
     */
    public function __construct($var = [], $element = null)
    {
        parent::__construct($var, $element);

        $this->containerClass = $this->var['container_class'] ?? $this->var['div'] ?? '';

        if ($this->element) {
            $this->elementUuid = $this->element->uuid;
            $this->uploadableType = get_class($this->element);
        }

        if ($this->element && $this->element->isUpdating()) {
            $this->elementId = $this->element->id;
            $this->tenantId = $this->element->tenant_id ?? null;
        }

        $this->moduleId = $this->var['module_id'] ?? $this->element->module()->id;

        $this->elementId = $this->var['element_id'] ?? $this->elementId;
        $this->elementUuid = $this->var['element_uuid'] ?? $this->elementUuid;
        $this->uploadableType = $this->var['uploadable_type'] ?? $this->uploadableType;
        $this->tenantId = $this->var['tenant_id'] ?? $this->tenantId;
        $this->bucket = $this->var['bucket'] ?? trim(config('mainframe.config.upload_root'), "\\/ ");
        $this->type = $this->var['type'] ?? null;
        $this->limit = $this->var['limit'] ?? 999;
        $this->postUrl = $this->var['url'] ?? route('uploads.store');
        $this->uploadBoxId = $this->var['upload_box_id'] ?? 'uploadBox'.Str::random(8);

        $this->zipDownload = $this->var['zip_download'] ?? $this->zipDownload;
        $this->showList = $this->var['show_list'] ?? $this->showList;
        $this->uploaderFunction = $this->var['uploader_function'] ?? 'initUploader';

        $this->isEditable = $this->var['editable'] ?? $this->isEditable();
        $this->badge = $this->var['badge'] ?? 'bg-gray';
        $this->sort = $this->var['sort'] ?? true;
        $this->deleteBtn = $this->var['delete_btn'] ?? true;
        $this->detailLink = $this->var['detail_link'] ?? true;
        $this->preview = $this->var['preview'] ?? true;
        $this->cardCss = $this->var['card_css'] ?? 'col-md-6';

    }

    /**
     * @return mixed|string
     */
    public function postUrl()
    {
        return $this->postUrl ?: route('uploads.store');
    }

    /**
     * @return mixed|string
     */
    public function bucket()
    {
        return $this->bucket;
    }

    /**
     * @return string
     */
    public function zipDownloadUrl()
    {
        return route('download.zip', ['module_id' => $this->moduleId, 'element_id' => $this->elementId, 'type' => $this->type]);
    }

    /**
     * Check if upload is allowed
     *
     * @return bool|mixed
     */
    public function isEditable()
    {
        if (isset($this->var['editable'])) {
            return $this->var['editable'];
        }
        if (!user()->can('create', \App\Upload::class)) {
            return false;
        }
        if (!user()->can('update', $this->element)) {
            return false;
        }

        return true;
    }

    /**
     * Get an array of uploads
     *
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|mixed
     */
    public function uploads()
    {
        if (isset($this->var['uploads'])) {
            return $this->var['uploads'];
        }

        $uploads = [];

        if ($this->showList) {
            if ($this->moduleId && $this->elementId) {
                $query = $this->element->uploads();
                if ($this->type) {
                    $query->where('type', $this->type);
                } else {
                    $query->whereNull('type');
                }
                $uploads = $query->orderBy('order', 'ASC')->orderBy('created_at', 'DESC')
                    ->offset(0)->take($this->limit)
                    ->get();
            }
        }

        return $uploads;
    }

    /**
     * Allow zip download
     *
     * @return bool
     */
    public function allowZipDownload()
    {
        return $this->zipDownload && $this->element->isCreated();
    }
}
