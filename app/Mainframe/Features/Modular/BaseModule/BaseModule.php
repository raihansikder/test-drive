<?php

namespace App\Mainframe\Features\Modular\BaseModule;

use App\Comment;
use App\Mainframe\Features\Core\Traits\Validable;
use App\Mainframe\Features\Modular\BaseModule\Traits\ModularTrait;
use App\Mainframe\Modules\Changes\Change;
use App\Module;
use App\Project;
use App\Spread;
use App\Tenant;
use App\Upload;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;
use Watson\Rememberable\Rememberable;

/**
 * Class BaseModule
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $tenant_id
 * @property string|null $name
 * @property bool $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 *
 * @method static bool|null forceDelete()
 * @method static Model|Builder|mixed remember($param)
 *
 * @property-read Collection|Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read User $creator
 * @property-read Project $project
 * @property-read Tenant $tenant
 * @property-read User $updater
 * @property-read Collection|Upload[] $uploads
 * @property-read int|null $uploads_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule newQuery()
 * @method static Builder|BaseModule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule query()
 * @method static bool|null restore()
 * @method static Builder|BaseModule withTrashed()
 * @method static Builder|BaseModule withoutTrashed()
 *
 * @mixin \Eloquent
 *
 * @property-read Collection|Change[] $changes
 * @property-read int|null $changes_count
 * @property-read Module $linkedModule
 * @property-read Collection|Spread[] $spreads
 * @property-read int|null $spreads_count
 *
 * @method \Illuminate\Database\Eloquent\Builder remember(mixed $timer)
 */
abstract class BaseModule extends Model implements Auditable, MfModuleInterface
{
    /*
    |--------------------------------------------------------------------------
    | Include Mainframe module traits
    |--------------------------------------------------------------------------
    */
    use ModularTrait,                // Laravel default trait to enable soft delete
        \OwenIt\Auditing\Auditable,               // Third party plugin to cache query
        Rememberable, // 3rd party audit log
        SoftDeletes,               // Mainframe modular features.
        Validable;                   // Allow validation

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
    protected $auditExclude = ['updated_at'];

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
