<?php

namespace App\Project\Modules\Notifications;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Notifications\Notification
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property string $data
 * @property string|null $read_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module|null $linkedModule
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Notification newModelQuery()
 * @method static Builder|Notification newQuery()
 * @method static Builder|Notification query()
 * @method static Builder|Notification whereCreatedAt($value)
 * @method static Builder|Notification whereCreatedBy($value)
 * @method static Builder|Notification whereData($value)
 * @method static Builder|Notification whereDeletedAt($value)
 * @method static Builder|Notification whereDeletedBy($value)
 * @method static Builder|Notification whereElementId($value)
 * @method static Builder|Notification whereElementUuid($value)
 * @method static Builder|Notification whereId($value)
 * @method static Builder|Notification whereModuleId($value)
 * @method static Builder|Notification whereName($value)
 * @method static Builder|Notification whereNameExt($value)
 * @method static Builder|Notification whereNotifiableId($value)
 * @method static Builder|Notification whereNotifiableType($value)
 * @method static Builder|Notification whereProjectId($value)
 * @method static Builder|Notification whereReadAt($value)
 * @method static Builder|Notification whereSlug($value)
 * @method static Builder|Notification whereTenantId($value)
 * @method static Builder|Notification whereType($value)
 * @method static Builder|Notification whereUpdatedAt($value)
 * @method static Builder|Notification whereUpdatedBy($value)
 * @method static Builder|Notification whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property int|null $is_active
 */
class Notification extends \App\Mainframe\Modules\Notifications\Notification
{
    use NotificationHelper;

    protected $moduleName = 'notifications';
    protected $table = 'notifications';

    /**
     * Disable auditing
     *
     * @var bool
     */
    public static $auditingDisabled = true;
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'name', 'type', 'notifiable_type', 'notifiable_id', 'module_id', 'element_id', 'element_uuid', 'data', 'read_at',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(NotificationObserver::class);
        // self::disableAuditing(); // Disable audit entry for this model.

        // static::saving(function (Notification $element) { });
        // static::creating(function (Notification $element) { });
        // static::updating(function (Notification $element) { });
        // static::created(function (Notification $element) { });
        // static::updated(function (Notification $element) { });
        // static::saved(function (Notification $element) { });
        // static::deleting(function (Notification $element) { });
        // static::deleted(function (Notification $element) { });
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

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return NotificationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
