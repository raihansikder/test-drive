<?php

namespace App\Project\Modules\ModuleGroups;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\ModuleGroups\ModuleGroup
 *
 * @property int $id
 * @property string|null $uuid
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $description
 * @property string|null $route_path
 * @property string|null $route_name
 * @property int|null $parent_id
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
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|ModuleGroup newModelQuery()
 * @method static Builder|ModuleGroup newQuery()
 * @method static Builder|ModuleGroup query()
 * @method static Builder|ModuleGroup whereColorCss($value)
 * @method static Builder|ModuleGroup whereCreatedAt($value)
 * @method static Builder|ModuleGroup whereCreatedBy($value)
 * @method static Builder|ModuleGroup whereDefaultRoute($value)
 * @method static Builder|ModuleGroup whereDeletedAt($value)
 * @method static Builder|ModuleGroup whereDeletedBy($value)
 * @method static Builder|ModuleGroup whereDescription($value)
 * @method static Builder|ModuleGroup whereIconCss($value)
 * @method static Builder|ModuleGroup whereId($value)
 * @method static Builder|ModuleGroup whereIsActive($value)
 * @method static Builder|ModuleGroup whereIsVisible($value)
 * @method static Builder|ModuleGroup whereLevel($value)
 * @method static Builder|ModuleGroup whereName($value)
 * @method static Builder|ModuleGroup whereNameExt($value)
 * @method static Builder|ModuleGroup whereOrder($value)
 * @method static Builder|ModuleGroup whereParentId($value)
 * @method static Builder|ModuleGroup whereRouteName($value)
 * @method static Builder|ModuleGroup whereRoutePath($value)
 * @method static Builder|ModuleGroup whereSlug($value)
 * @method static Builder|ModuleGroup whereTitle($value)
 * @method static Builder|ModuleGroup whereUpdatedAt($value)
 * @method static Builder|ModuleGroup whereUpdatedBy($value)
 * @method static Builder|ModuleGroup whereUuid($value)
 * @mixin \Eloquent
 * @property-read string|null $icon_html
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class ModuleGroup extends \App\Mainframe\Modules\ModuleGroups\ModuleGroup
{
    use ModuleGroupHelper;

    protected $moduleName = 'module-groups';
    protected $table = 'module_groups';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['id', 'uuid', 'name',// 'name_ext', 'slug', 'title', 'description', 'route_path', 'route_name', 'parent_id', 'level', 'order', 'default_route', 'color_css', 'icon_css', 'is_visible', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at', 'deleted_by', ];

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
        self::observe(ModuleGroupObserver::class);

        // static::saving(function (ModuleGroup $element) { });
        // static::creating(function (ModuleGroup $element) { });
        // static::updating(function (ModuleGroup $element) { });
        // static::created(function (ModuleGroup $element) { });
        // static::updated(function (ModuleGroup $element) { });
        // static::saved(function (ModuleGroup $element) { });
        // static::deleting(function (ModuleGroup $element) { });
        // static::deleted(function (ModuleGroup $element) { });
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
     * @return ModuleGroupProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
