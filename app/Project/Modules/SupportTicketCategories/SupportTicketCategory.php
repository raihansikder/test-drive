<?php

namespace App\Project\Modules\SupportTicketCategories;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\SupportTicketCategories\SupportTicketCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SupportTicketCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\User $creator
 * @property-read \App\Module $linkedModule
 * @property-read SupportTicketCategory $parent
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SupportTicketCategory[] $subLevels
 * @property-read int|null $sub_levels_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User $updater
 * @method static Builder|BaseModule active()
 * @method static Builder|SupportTicketCategory newModelQuery()
 * @method static Builder|SupportTicketCategory newQuery()
 * @method static Builder|SupportTicketCategory query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property array|null $email_recipients
 * @property int|null $parent_id
 * @property string|null $parent_name
 * @property array|null $upper_level_ids
 * @property array|null $lower_level_ids
 * @property array|null $parallel_level_ids
 * @property int|null $order
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
 * @method static Builder|SupportTicketCategory whereCreatedAt($value)
 * @method static Builder|SupportTicketCategory whereCreatedBy($value)
 * @method static Builder|SupportTicketCategory whereDeletedAt($value)
 * @method static Builder|SupportTicketCategory whereDeletedBy($value)
 * @method static Builder|SupportTicketCategory whereEmailRecipients($value)
 * @method static Builder|SupportTicketCategory whereId($value)
 * @method static Builder|SupportTicketCategory whereIsActive($value)
 * @method static Builder|SupportTicketCategory whereLowerLevelIds($value)
 * @method static Builder|SupportTicketCategory whereName($value)
 * @method static Builder|SupportTicketCategory whereNameExt($value)
 * @method static Builder|SupportTicketCategory whereOrder($value)
 * @method static Builder|SupportTicketCategory whereParallelLevelIds($value)
 * @method static Builder|SupportTicketCategory whereParentId($value)
 * @method static Builder|SupportTicketCategory whereParentName($value)
 * @method static Builder|SupportTicketCategory whereProjectId($value)
 * @method static Builder|SupportTicketCategory whereSlug($value)
 * @method static Builder|SupportTicketCategory whereTenantId($value)
 * @method static Builder|SupportTicketCategory whereUpdatedAt($value)
 * @method static Builder|SupportTicketCategory whereUpdatedBy($value)
 * @method static Builder|SupportTicketCategory whereUpperLevelIds($value)
 * @method static Builder|SupportTicketCategory whereUuid($value)
 */
class SupportTicketCategory extends \App\Mainframe\Modules\SupportTicketCategories\SupportTicketCategory
{
    use SupportTicketCategoryHelper;

    protected $moduleName = 'support-ticket-categories';
    protected $table = 'support_ticket_categories';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'name_ext', 'email_recipients', 'parent_id', 'parent_name', 'upper_level_ids', 'lower_level_ids', 'parallel_level_ids', 'order', 'slug', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = ['lower_level_ids' => 'array', 'upper_level_ids' => 'array', 'parallel_level_ids' => 'array', 'email_recipients' => 'array',];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

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
        self::observe(SupportTicketCategoryObserver::class);

        // static::saving(function (SupportTicketCategory $element) { });
        // static::creating(function (SupportTicketCategory $element) { });
        // static::updating(function (SupportTicketCategory $element) { });
        // static::created(function (SupportTicketCategory $element) { });
        // static::updated(function (SupportTicketCategory $element) { });
        // static::saved(function (SupportTicketCategory $element) { });
        // static::deleting(function (SupportTicketCategory $element) { });
        // static::deleted(function (SupportTicketCategory $element) { });
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
     * @return SupportTicketCategoryProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
