<?php

namespace App\Project\Modules\Modules;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Modules\Module
 *
 * @property int $id
 * @property string|null $uuid
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $module_table
 * @property string|null $route_path /relative/path/to/index
 * @property string|null $route_name some.name
 * @property string|null $class_directory app/Mainframe/Modules/SomeModules
 * @property string|null $namespace
 * @property string|null $model app/Mainframe/Modules/SomeModules/NameOfModule
 * @property string|null $policy
 * @property string|null $processor
 * @property string|null $controller
 * @property string|null $view_directory
 * @property int|null $parent_id
 * @property int|null $module_group_id
 * @property int|null $level
 * @property int|null $order
 * @property string|null $default_route
 * @property string|null $color_css
 * @property string|null $icon_css
 * @property int|null $is_visible
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
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Module newModelQuery()
 * @method static Builder|Module newQuery()
 * @method static Builder|Module query()
 * @method static Builder|Module whereClassDirectory($value)
 * @method static Builder|Module whereColorCss($value)
 * @method static Builder|Module whereController($value)
 * @method static Builder|Module whereCreatedAt($value)
 * @method static Builder|Module whereCreatedBy($value)
 * @method static Builder|Module whereDefaultRoute($value)
 * @method static Builder|Module whereDeletedAt($value)
 * @method static Builder|Module whereDeletedBy($value)
 * @method static Builder|Module whereDescription($value)
 * @method static Builder|Module whereIconCss($value)
 * @method static Builder|Module whereId($value)
 * @method static Builder|Module whereIsActive($value)
 * @method static Builder|Module whereIsVisible($value)
 * @method static Builder|Module whereLevel($value)
 * @method static Builder|Module whereModel($value)
 * @method static Builder|Module whereModuleGroupId($value)
 * @method static Builder|Module whereModuleTable($value)
 * @method static Builder|Module whereName($value)
 * @method static Builder|Module whereNameExt($value)
 * @method static Builder|Module whereNamespace($value)
 * @method static Builder|Module whereOrder($value)
 * @method static Builder|Module whereParentId($value)
 * @method static Builder|Module wherePolicy($value)
 * @method static Builder|Module whereProcessor($value)
 * @method static Builder|Module whereProjectId($value)
 * @method static Builder|Module whereRouteName($value)
 * @method static Builder|Module whereRoutePath($value)
 * @method static Builder|Module whereSlug($value)
 * @method static Builder|Module whereTenantId($value)
 * @method static Builder|Module whereTitle($value)
 * @method static Builder|Module whereUpdatedAt($value)
 * @method static Builder|Module whereUpdatedBy($value)
 * @method static Builder|Module whereUuid($value)
 * @method static Builder|Module whereViewDirectory($value)
 * @mixin \Eloquent
 * @property-read string|null $icon_html
 * @property-read mixed $menu_item_name
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Module extends \App\Mainframe\Modules\Modules\Module
{
    use ModuleHelper;

    protected $moduleName = 'modules';
    protected $table = 'modules';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'project_id', 'tenant_id', 'title', 'description', 'module_table', 'route_path', 'route_name', 'class_directory', 'namespace', 'model', 'policy', 'processor', 'controller', 'view', 'parent_id', 'module_group_id', 'level', 'order', 'default_route', 'color_css', 'icon_css', 'is_active',];
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
        self::observe(ModuleObserver::class);

        // static::saving(function (Module $element) { });
        // static::creating(function (Module $element) { });
        // static::updating(function (Module $element) { });
        // static::created(function (Module $element) { });
        // static::updated(function (Module $element) { });
        // static::saved(function (Module $element) { });
        // static::deleting(function (Module $element) { });
        // static::deleted(function (Module $element) { });
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
     * @return ModuleProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
