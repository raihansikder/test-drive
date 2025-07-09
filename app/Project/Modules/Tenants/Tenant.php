<?php

namespace App\Project\Modules\Tenants;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Tenants\Tenant
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $code
 * @property int|null $user_id Tenant admin who signed up
 * @property string|null $route_group
 * @property string|null $class_directory
 * @property string|null $namespace
 * @property string|null $view_directory
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
 * @property-read \App\User|null $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Tenant newModelQuery()
 * @method static Builder|Tenant newQuery()
 * @method static Builder|Tenant query()
 * @method static Builder|Tenant whereClassDirectory($value)
 * @method static Builder|Tenant whereCode($value)
 * @method static Builder|Tenant whereCreatedAt($value)
 * @method static Builder|Tenant whereCreatedBy($value)
 * @method static Builder|Tenant whereDeletedAt($value)
 * @method static Builder|Tenant whereDeletedBy($value)
 * @method static Builder|Tenant whereId($value)
 * @method static Builder|Tenant whereIsActive($value)
 * @method static Builder|Tenant whereName($value)
 * @method static Builder|Tenant whereNameExt($value)
 * @method static Builder|Tenant whereNamespace($value)
 * @method static Builder|Tenant whereProjectId($value)
 * @method static Builder|Tenant whereRouteGroup($value)
 * @method static Builder|Tenant whereSlug($value)
 * @method static Builder|Tenant whereUpdatedAt($value)
 * @method static Builder|Tenant whereUpdatedBy($value)
 * @method static Builder|Tenant whereUserId($value)
 * @method static Builder|Tenant whereUuid($value)
 * @method static Builder|Tenant whereViewDirectory($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Tenant extends \App\Mainframe\Modules\Tenants\Tenant
{
    use TenantHelper;

    protected $moduleName = 'tenants';
    protected $table = 'tenants';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'is_active',];
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
        self::observe(TenantObserver::class);

        // static::saving(function (Tenant $element) { });
        // static::creating(function (Tenant $element) { });
        // static::updating(function (Tenant $element) { });
        // static::created(function (Tenant $element) { });
        // static::updated(function (Tenant $element) { });
        // static::saved(function (Tenant $element) { });
        // static::deleting(function (Tenant $element) { });
        // static::deleted(function (Tenant $element) { });
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
     * @return TenantProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
