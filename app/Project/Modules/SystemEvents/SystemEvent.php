<?php

namespace App\Project\Modules\SystemEvents;

use App\User;
use App\Module;
use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\SystemEvents\SystemEvent
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property array|null $details
 * @property string|null $provider
 * @property string|null $source
 * @property string|null $environment
 * @property string|null $version
 * @property string|null $type
 * @property string|null $content
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property int|null $user_id
 * @property string|null $occurred_at
 * @property array|null $tags
 * @property string|null $url
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $is_active
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read User|null $creator
 * @property-read Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @property-read User|null $user
 * @method static Builder|BaseModule active()
 * @method static Builder|SystemEvent newModelQuery()
 * @method static Builder|SystemEvent newQuery()
 * @method static Builder|SystemEvent query()
 * @method static Builder|SystemEvent whereContent($value)
 * @method static Builder|SystemEvent whereCreatedAt($value)
 * @method static Builder|SystemEvent whereCreatedBy($value)
 * @method static Builder|SystemEvent whereDeletedAt($value)
 * @method static Builder|SystemEvent whereDeletedBy($value)
 * @method static Builder|SystemEvent whereDetails($value)
 * @method static Builder|SystemEvent whereElementId($value)
 * @method static Builder|SystemEvent whereElementUuid($value)
 * @method static Builder|SystemEvent whereEnvironment($value)
 * @method static Builder|SystemEvent whereId($value)
 * @method static Builder|SystemEvent whereIpAddress($value)
 * @method static Builder|SystemEvent whereIsActive($value)
 * @method static Builder|SystemEvent whereModuleId($value)
 * @method static Builder|SystemEvent whereName($value)
 * @method static Builder|SystemEvent whereNameExt($value)
 * @method static Builder|SystemEvent whereOccurredAt($value)
 * @method static Builder|SystemEvent whereProjectId($value)
 * @method static Builder|SystemEvent whereProvider($value)
 * @method static Builder|SystemEvent whereSlug($value)
 * @method static Builder|SystemEvent whereSource($value)
 * @method static Builder|SystemEvent whereTags($value)
 * @method static Builder|SystemEvent whereTenantId($value)
 * @method static Builder|SystemEvent whereType($value)
 * @method static Builder|SystemEvent whereUpdatedAt($value)
 * @method static Builder|SystemEvent whereUpdatedBy($value)
 * @method static Builder|SystemEvent whereUrl($value)
 * @method static Builder|SystemEvent whereUserAgent($value)
 * @method static Builder|SystemEvent whereUserId($value)
 * @method static Builder|SystemEvent whereUuid($value)
 * @method static Builder|SystemEvent whereVersion($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class SystemEvent extends \App\Mainframe\Modules\SystemEvents\SystemEvent
{
    use SystemEventHelper;

    protected $moduleName = 'system-events';
    protected $table = 'system_events';

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
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'details', 'provider', 'source', 'environment', 'version', 'type', 'content', 'module_id', 'element_id', 'element_uuid', 'user_id', 'occurred_at', 'tags', 'url', 'ip_address', 'user_agent', 'name_ext', 'slug', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = ['tags' => 'array', 'details' => 'array',];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];
    // public static $envs = ['local', 'development', 'staging', 'production'];
    // public static $types = ['Issue', 'Event', 'Log'];
    // public static $sources = ['BE', 'Android', 'iOS'];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(SystemEventObserver::class);
        // self::disableAuditing(); // Disable audit entry for this model.

        // static::saving(function (SystemEvent $element) { });
        // static::creating(function (SystemEvent $element) { });
        // static::updating(function (SystemEvent $element) { });
        // static::created(function (SystemEvent $element) { });
        // static::updated(function (SystemEvent $element) { });
        // static::saved(function (SystemEvent $element) { });
        // static::deleting(function (SystemEvent $element) { });
        // static::deleted(function (SystemEvent $element) { });
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
     * @return SystemEventProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
