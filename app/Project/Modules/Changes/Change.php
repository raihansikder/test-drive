<?php

namespace App\Project\Modules\Changes;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Changes\Change
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $changeable_id
 * @property string|null $changeable_type
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property string|null $field
 * @property string|null $old
 * @property string|null $new
 * @property string|null $note
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $changeable
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
 * @method static Builder|Change newModelQuery()
 * @method static Builder|Change newQuery()
 * @method static Builder|Change query()
 * @method static Builder|Change whereChangeableId($value)
 * @method static Builder|Change whereChangeableType($value)
 * @method static Builder|Change whereCreatedAt($value)
 * @method static Builder|Change whereCreatedBy($value)
 * @method static Builder|Change whereDeletedAt($value)
 * @method static Builder|Change whereDeletedBy($value)
 * @method static Builder|Change whereElementId($value)
 * @method static Builder|Change whereElementUuid($value)
 * @method static Builder|Change whereField($value)
 * @method static Builder|Change whereId($value)
 * @method static Builder|Change whereIsActive($value)
 * @method static Builder|Change whereModuleId($value)
 * @method static Builder|Change whereName($value)
 * @method static Builder|Change whereNameExt($value)
 * @method static Builder|Change whereNew($value)
 * @method static Builder|Change whereNote($value)
 * @method static Builder|Change whereOld($value)
 * @method static Builder|Change whereProjectId($value)
 * @method static Builder|Change whereSlug($value)
 * @method static Builder|Change whereTenantId($value)
 * @method static Builder|Change whereUpdatedAt($value)
 * @method static Builder|Change whereUpdatedBy($value)
 * @method static Builder|Change whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Change extends \App\Mainframe\Modules\Changes\Change
{
    use ChangeHelper;

    protected $moduleName = 'changes';
    protected $table = 'changes';

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
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'changeable_id', 'changeable_type', 'module_id', 'element_id', 'element_uuid', 'field', 'old', 'new', 'note', 'is_active',];
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
        self::observe(ChangeObserver::class);

        // static::saving(function (Change $element) { });
        // static::creating(function (Change $element) { });
        // static::updating(function (Change $element) { });
        // static::created(function (Change $element) { });
        // static::updated(function (Change $element) { });
        // static::saved(function (Change $element) { });
        // static::deleting(function (Change $element) { });
        // static::deleted(function (Change $element) { });
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
     * @return ChangeProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
