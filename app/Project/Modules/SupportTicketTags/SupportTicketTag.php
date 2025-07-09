<?php

namespace App\Project\Modules\SupportTicketTags;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\SupportTicketTags\SupportTicketTag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\User $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User $updater
 * @method static Builder|BaseModule active()
 * @method static Builder|SupportTicketTag newModelQuery()
 * @method static Builder|SupportTicketTag newQuery()
 * @method static Builder|SupportTicketTag query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $description
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
 * @method static Builder|SupportTicketTag whereCreatedAt($value)
 * @method static Builder|SupportTicketTag whereCreatedBy($value)
 * @method static Builder|SupportTicketTag whereDeletedAt($value)
 * @method static Builder|SupportTicketTag whereDeletedBy($value)
 * @method static Builder|SupportTicketTag whereDescription($value)
 * @method static Builder|SupportTicketTag whereId($value)
 * @method static Builder|SupportTicketTag whereIsActive($value)
 * @method static Builder|SupportTicketTag whereName($value)
 * @method static Builder|SupportTicketTag whereNameExt($value)
 * @method static Builder|SupportTicketTag whereProjectId($value)
 * @method static Builder|SupportTicketTag whereSlug($value)
 * @method static Builder|SupportTicketTag whereTenantId($value)
 * @method static Builder|SupportTicketTag whereUpdatedAt($value)
 * @method static Builder|SupportTicketTag whereUpdatedBy($value)
 * @method static Builder|SupportTicketTag whereUuid($value)
 */
class SupportTicketTag extends \App\Mainframe\Modules\SupportTicketTags\SupportTicketTag
{
    use SupportTicketTagHelper;

    protected $moduleName = 'support-ticket-tags';
    protected $table = 'support_ticket_tags';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'description', 'is_active',];
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

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(SupportTicketTagObserver::class);

        // static::saving(function (SupportTicketTag $element) { });
        // static::creating(function (SupportTicketTag $element) { });
        // static::updating(function (SupportTicketTag $element) { });
        // static::created(function (SupportTicketTag $element) { });
        // static::updated(function (SupportTicketTag $element) { });
        // static::saved(function (SupportTicketTag $element) { });
        // static::deleting(function (SupportTicketTag $element) { });
        // static::deleted(function (SupportTicketTag $element) { });
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
     * @return SupportTicketTagProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
