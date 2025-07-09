<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadTrait;
use App\Project\Features\Modular\BaseModule\BaseModule;

class Upload extends BaseModule
{
    use UploadTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'type',
        'path',
        'order',
        'ext',
        'bytes',
        'description',
        'module_id',
        'element_id',
        'element_uuid',
        'uploadable_id',
        'uploadable_type',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = ['url', 'dir'];
    protected $hidden = ['linked_module'];

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */
    /**
     * Upload type options
     */
    public const TYPE_GENERIC = 'Generic';
    public const TYPE_PROFILE_PIC = 'Profile Picture';
    public const TYPE_LOGO = 'Logo';
    public const TYPE_SUPPORTING_DOCUMENT = 'Supporting Document';
    public const TYPE_SETTING_PUBLIC = 'Setting (Public)';

    public static $types = [
        self::TYPE_GENERIC,
        self::TYPE_PROFILE_PIC,
        self::TYPE_LOGO,
        self::TYPE_SUPPORTING_DOCUMENT,
        self::TYPE_SETTING_PUBLIC,
    ];

    /**
     * Keeps only the latest file and deletes old.
     * For cases like profile pic
     *
     * @var string[]
     */
    public static $typesWithSingleImage = [
        self::TYPE_PROFILE_PIC,
        self::TYPE_LOGO,
    ];

}
