<?php

namespace App\Project\Modules\Projects;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Project
 *
 * @property int $id
 * @property string|null $uuid
 * @property string|null $code
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $configuration JSON configuration for a project
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
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereClassDirectory($value)
 * @method static Builder|Project whereCode($value)
 * @method static Builder|Project whereConfiguration($value)
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereCreatedBy($value)
 * @method static Builder|Project whereDeletedAt($value)
 * @method static Builder|Project whereDeletedBy($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereIsActive($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project whereNameExt($value)
 * @method static Builder|Project whereNamespace($value)
 * @method static Builder|Project whereRouteGroup($value)
 * @method static Builder|Project whereSlug($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUpdatedBy($value)
 * @method static Builder|Project whereUuid($value)
 * @method static Builder|Project whereViewDirectory($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Project extends \App\Mainframe\Modules\Projects\Project
{
    use ProjectHelper;

    protected $moduleName = 'projects';
    protected $table = 'projects';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['uuid', 'name', 'code', 'name', 'description', 'configuration', 'is_active',];
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
        self::observe(ProjectObserver::class);

        // static::saving(function (Project $element) { });
        // static::creating(function (Project $element) { });
        // static::updating(function (Project $element) { });
        // static::created(function (Project $element) { });
        // static::updated(function (Project $element) { });
        // static::saved(function (Project $element) { });
        // static::deleting(function (Project $element) { });
        // static::deleted(function (Project $element) { });
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
     * @return ProjectProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
