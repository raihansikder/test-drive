<?php

namespace App\Mainframe\Features\Modular\BaseModule;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mainframe\Features\Core\Traits\Validable;
use App\Mainframe\Features\Modular\BaseModule\Traits\ModularTrait;

/**
 * Class BaseModule
 *
 * @package App
 * @property int $id
 * @property string|null $uuid
 * @property int|null $tenant_id
 * @property string|null $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @method static bool|null forceDelete()
 * @method static Model|Builder|mixed remember($param)
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\User $creator
 * @property-read \App\Project $project
 * @property-read \App\Tenant $tenant
 * @property-read \App\User $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newQuery()
 * @method static Builder|BaseModule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule query()
 * @method static bool|null restore()
 * @method static Builder|BaseModule withTrashed()
 * @method static Builder|BaseModule withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Modules\Changes\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\Module $linkedModule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @method \Illuminate\Database\Eloquent\Builder remember(mixed $timer)
 */
class BaseModule extends Model implements Auditable
{
    /*
    |--------------------------------------------------------------------------
    | Include Mainframe module traits
    |--------------------------------------------------------------------------
    */
    use SoftDeletes,                // Laravel default trait to enable soft delete
        Rememberable,               // Third party plugin to cache query
        \OwenIt\Auditing\Auditable, // 3rd party audit log
        ModularTrait,               // Mainframe modular features.
        Validable                   // Allow validation
        ;

    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = ''; // Note: demo module name to create ide-helper doc block

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */
    /**
     * Dates
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Hidden fields in serialized output/json
     *
     * @var array
     */
    protected $hidden = ['project_id', 'tenant_id', 'deleted_by', 'deleted_at'];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = ['updated_at',];

    /**
     * Casts
     *
     * @var array
     */
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime', 'deleted_at' => 'datetime'];

    /*
    |--------------------------------------------------------------------------
    | Code: Spread configs
    |--------------------------------------------------------------------------
    */

    /**
     * Define the spread attribute mapping that link to a another model.
     * Note: Table field must follow *_model_ids, i.e. visited_country_ids, active_group_ids
     * 'group_ids' => Group::class,
     *
     * @var array
     */
    protected $spreadFields = [];

    /**
     * Define the tag attributes of the model that will be saved in spreads table.
     *
     * @var array
     */
    protected $tagFields = [];

    /*
    |--------------------------------------------------------------------------
    | Code: Tenant configs
    |--------------------------------------------------------------------------
    */
    /**
     * Enable tenant context
     *
     * @var bool
     */
    protected $tenantEnabled = false;

    /**
     * If true, then tenants will be able to see items where tenant_id=0
     *
     * @var bool
     */
    protected $showGlobalTenantElements = true;

    /**
     * If true, then tenants will be able to see items where tenant_id=null
     *
     * @var bool
     */
    protected $showNonTenantElements = true;

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    | Note: Do not run the boot method here. Write your boot method in project class
    |--------------------------------------------------------------------------
    */
    // protected static function boot()
    // {
    //     parent::boot();
    //
    // }
}
