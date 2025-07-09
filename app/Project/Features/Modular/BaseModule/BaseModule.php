<?php

namespace App\Project\Features\Modular\BaseModule;

use App\Assignment;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Mainframe\Features\Multitenant\GlobalScope\CheckTenantScope;

/**
 * App\Project\Features\Modular\BaseModule\BaseModule
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule query()
 * @mixin \Eloquent
 * @method static Builder|BaseModule onlyTrashed()
 * @method static Builder|BaseModule withTrashed()
 * @method static Builder|BaseModule withoutTrashed()
 */
class BaseModule extends \App\Mainframe\Features\Modular\BaseModule\BaseModule
{
    /*
    |--------------------------------------------------------------------------
    | Include Mainframe module traits
    |--------------------------------------------------------------------------
    */
    // use SoftDeletes,                // Laravel default trait to enable soft delete
    //     Rememberable,               // Third party plugin to cache query
    //     Auditable,                  // 3rd party audit log
    //     ModularTrait,               // Mainframe modular features.
    //     Validable                   // Allow validation
    //     ;

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
     * If true then tenants will be able to see items where tenant_id=0
     *
     * @var bool
     */
    protected $showGlobalTenantElements = true;

    /**
     * If true then tenants will be able to see items where tenant_id=null
     *
     * @var bool
     */
    protected $showNonTenantElements = true;

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    | Note: Do not run the boot method here. Write your boot method in project's BaseModule
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        // Add tenant scope to model if current user() belongs to a tenant
        if (user()->ofTenant()) {
            static::addGlobalScope(new CheckTenantScope);
        }
    }

    /**
     * @return MorphMany
     */
    public function assignments()
    {
        return $this->morphMany(Assignment::class, 'assignable');
    }

}
