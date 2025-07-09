<?php

namespace App\Project\Modules\Uploads;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Uploads\Upload
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $path
 * @property int|null $order
 * @property string|null $ext
 * @property int|null $bytes
 * @property string|null $description
 * @property string|null $uploadable_type
 * @property int|null $uploadable_id
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read mixed $dir
 * @property-read mixed $url
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $uploadable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Upload newModelQuery()
 * @method static Builder|Upload newQuery()
 * @method static Builder|Upload query()
 * @method static Builder|Upload whereBytes($value)
 * @method static Builder|Upload whereCreatedAt($value)
 * @method static Builder|Upload whereCreatedBy($value)
 * @method static Builder|Upload whereDeletedAt($value)
 * @method static Builder|Upload whereDeletedBy($value)
 * @method static Builder|Upload whereDescription($value)
 * @method static Builder|Upload whereElementId($value)
 * @method static Builder|Upload whereElementUuid($value)
 * @method static Builder|Upload whereExt($value)
 * @method static Builder|Upload whereId($value)
 * @method static Builder|Upload whereIsActive($value)
 * @method static Builder|Upload whereModuleId($value)
 * @method static Builder|Upload whereName($value)
 * @method static Builder|Upload whereOrder($value)
 * @method static Builder|Upload wherePath($value)
 * @method static Builder|Upload whereProjectId($value)
 * @method static Builder|Upload whereTenantId($value)
 * @method static Builder|Upload whereType($value)
 * @method static Builder|Upload whereUpdatedAt($value)
 * @method static Builder|Upload whereUpdatedBy($value)
 * @method static Builder|Upload whereUploadableId($value)
 * @method static Builder|Upload whereUploadableType($value)
 * @method static Builder|Upload whereUuid($value)
 * @mixin \Eloquent
 * @property string|null $name_ext
 * @property string|null $slug
 * @method static Builder|Upload whereNameExt($value)
 * @method static Builder|Upload whereSlug($value)
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read string $download_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Upload extends \App\Mainframe\Modules\Uploads\Upload
{
    use UploadHelper;

    protected $moduleName = 'uploads';
    protected $table = 'uploads';

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'type', 'path', 'order', 'ext', 'bytes', 'description', 'module_id', 'element_id', 'element_uuid', 'uploadable_id', 'uploadable_type', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = ['url', 'dir'];
    // protected $hidden = ['linked_module'];

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Upload type options
    //  */
    // public const TYPE_GENERIC             = 'Generic';
    // public const TYPE_SETTING_PUBLIC      = 'Setting (Public)';
    // public const TYPE_PROFILE_PIC         = 'Profile Picture';
    // public const TYPE_LOGO                = 'Logo';
    // public const TYPE_SUPPORTING_DOCUMENT = 'Supporting Document';
    //
    // public static $types = [
    //     self::TYPE_GENERIC,
    //     self::TYPE_PROFILE_PIC,
    //     self::TYPE_LOGO,
    //     self::TYPE_SUPPORTING_DOCUMENT,
    // ];
    //
    // /**
    //  * Keeps only the latest file and deletes old.
    //  * For cases like profile pic
    //  *
    //  * @var string[]
    //  */
    // public static $typesWithSingleImage = [
    //     self::TYPE_PROFILE_PIC,
    //     self::TYPE_LOGO,
    // ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(UploadObserver::class);

        // static::saving(function (Upload $element) { });
        // static::creating(function (Upload $element) { });
        // static::updating(function (Upload $element) { });
        // static::created(function (Upload $element) { });
        // static::updated(function (Upload $element) { });
        // static::saved(function (Upload $element) { });
        // static::deleting(function (Upload $element) { });
        // static::deleted(function (Upload $element) { });
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

    // public function getFirstNameAttribute($value) { return ucfirst($value); }

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

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

}
