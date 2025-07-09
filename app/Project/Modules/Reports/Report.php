<?php

namespace App\Project\Modules\Reports;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Reports\Report
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $code
 * @property string|null $title
 * @property string|null $description
 * @property string|null $parameters
 * @property string|null $type
 * @property string|null $version
 * @property int|null $module_id
 * @property int|null $is_module_default
 * @property string|null $tags
 * @property int|null $is_tenant_editable Some settings are not allowed to be edited by tenant
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
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Report newModelQuery()
 * @method static Builder|Report newQuery()
 * @method static Builder|Report query()
 * @method static Builder|Report whereCode($value)
 * @method static Builder|Report whereCreatedAt($value)
 * @method static Builder|Report whereCreatedBy($value)
 * @method static Builder|Report whereDeletedAt($value)
 * @method static Builder|Report whereDeletedBy($value)
 * @method static Builder|Report whereDescription($value)
 * @method static Builder|Report whereId($value)
 * @method static Builder|Report whereIsActive($value)
 * @method static Builder|Report whereIsModuleDefault($value)
 * @method static Builder|Report whereIsTenantEditable($value)
 * @method static Builder|Report whereModuleId($value)
 * @method static Builder|Report whereName($value)
 * @method static Builder|Report whereNameExt($value)
 * @method static Builder|Report whereParameters($value)
 * @method static Builder|Report whereProjectId($value)
 * @method static Builder|Report whereSlug($value)
 * @method static Builder|Report whereTags($value)
 * @method static Builder|Report whereTenantId($value)
 * @method static Builder|Report whereTitle($value)
 * @method static Builder|Report whereType($value)
 * @method static Builder|Report whereUpdatedAt($value)
 * @method static Builder|Report whereUpdatedBy($value)
 * @method static Builder|Report whereUuid($value)
 * @method static Builder|Report whereVersion($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Report extends \App\Mainframe\Modules\Reports\Report
{
    use ReportHelper;

    protected $moduleName = 'reports';
    protected $table = 'reports';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'name_ext', 'slug', 'code', 'title', 'description', 'parameters', 'type', 'version', 'module_id', 'is_module_default', 'tags', 'is_tenant_editable', 'is_active',];

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
        self::observe(ReportObserver::class);

        // static::saving(function (Report $element) { });
        // static::creating(function (Report $element) { });
        // static::updating(function (Report $element) { });
        // static::created(function (Report $element) { });
        // static::updated(function (Report $element) { });
        // static::saved(function (Report $element) { });
        // static::deleting(function (Report $element) { });
        // static::deleted(function (Report $element) { });
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
     * @return ReportProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
