<?php

namespace App\Project\Modules\Assignments;

use App\User;
use App\Module;
use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Assignments\Assignment
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $assignable
 * @property-read User $assignedBy
 * @property-read User $assignee
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read User $creator
 * @property-read Module $linkedModule
 * @property-read \App\Project $project
 * @property-read Module $relatedModule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read User $updater
 * @property-read User $user
 * @method static Builder|BaseModule active()
 * @method static Builder|Assignment newModelQuery()
 * @method static Builder|Assignment newQuery()
 * @method static Builder|Assignment query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property string|null $assignable_type
 * @property int|null $assignable_id
 * @property int|null $assignee_user_id
 * @property string|null $status
 * @property string|null $note
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Assignment whereAssignableId($value)
 * @method static Builder|Assignment whereAssignableType($value)
 * @method static Builder|Assignment whereAssigneeUserId($value)
 * @method static Builder|Assignment whereCreatedAt($value)
 * @method static Builder|Assignment whereCreatedBy($value)
 * @method static Builder|Assignment whereDeletedAt($value)
 * @method static Builder|Assignment whereDeletedBy($value)
 * @method static Builder|Assignment whereElementId($value)
 * @method static Builder|Assignment whereElementUuid($value)
 * @method static Builder|Assignment whereId($value)
 * @method static Builder|Assignment whereIsActive($value)
 * @method static Builder|Assignment whereModuleId($value)
 * @method static Builder|Assignment whereName($value)
 * @method static Builder|Assignment whereNameExt($value)
 * @method static Builder|Assignment whereNote($value)
 * @method static Builder|Assignment whereProjectId($value)
 * @method static Builder|Assignment whereSlug($value)
 * @method static Builder|Assignment whereStatus($value)
 * @method static Builder|Assignment whereTenantId($value)
 * @method static Builder|Assignment whereType($value)
 * @method static Builder|Assignment whereUpdatedAt($value)
 * @method static Builder|Assignment whereUpdatedBy($value)
 * @method static Builder|Assignment whereUuid($value)
 */
class Assignment extends \App\Mainframe\Modules\Assignments\Assignment
{
    use AssignmentHelper;

    protected $moduleName = 'assignments';
    protected $table = 'assignments';

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'type', 'module_id', 'element_id', 'element_uuid', 'assignable_type', 'assignable_id', 'assignee_user_id', 'status', 'note', 'name_ext', 'slug', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];
    public $emailTemplate = 'project.emails.assignment-created';

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(AssignmentObserver::class);

        // static::saving(function (Assignment $element) { });
        // static::creating(function (Assignment $element) { });
        // static::updating(function (Assignment $element) { });
        // static::created(function (Assignment $element) { });
        // static::updated(function (Assignment $element) { });
        // static::saved(function (Assignment $element) { });
        // static::deleting(function (Assignment $element) { });
        // static::deleted(function (Assignment $element) { });

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
     * @return AssignmentProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
