<?php

namespace App\Project\Modules\SupportTickets;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Project\Modules\SupportTickets\SupportTicket
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property int|null $division_id
 * @property string|null $division_name
 * @property int|null $district_id
 * @property string|null $district_name
 * @property int|null $upazila_id
 * @property string|null $upazila_name
 * @property int|null $user_id
 * @property string|null $details
 * @property string|null $contact_no
 * @property int|null $primary_category_id
 * @property string|null $primary_category_name
 * @property int|null $secondary_category_id
 * @property string|null $secondary_category_name
 * @property array|null $support_ticket_tag_ids
 * @property array|null $support_ticket_tag_names
 * @property string|null $support_ticket_tag_names_formatted
 * @property string|null $status_name
 * @property string|null $reviewers_note
 * @property string|null $slug
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\SupportTicketCategory|null $primaryCategory
 * @property-read \App\Project|null $project
 * @property-read \App\SupportTicketCategory|null $secondaryCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|BaseModule active()
 * @method static Builder|SupportTicket newModelQuery()
 * @method static Builder|SupportTicket newQuery()
 * @method static Builder|SupportTicket query()
 * @mixin \Eloquent
 */
class SupportTicket extends \App\Mainframe\Modules\SupportTickets\SupportTicket
{
    use SupportTicketHelper;

    protected $moduleName = 'support-tickets';
    protected $table = 'support_tickets';

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'name_ext', 'division_id',//'division_name', 'district_id', //'district_name', 'upazila_id', //'upazila_name', 'user_id', 'details', 'contact_no', 'primary_category_id', //'primary_category_name', 'secondary_category_id', //'secondary_category_name', 'support_ticket_tag_ids', 'support_ticket_tag_names', 'support_ticket_tag_names_formatted', 'status_name', 'reviewers_note', 'slug', 'is_active', ];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = ['support_ticket_tag_ids' => 'array', 'support_ticket_tag_names' => 'array',];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!
    // protected $spreadFields = ['support_ticket_tag_ids' => SupportTicketTag::class,];
    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

    // Note:See parent class
    // public const SUPPORT_TICKET_STATUS_NEW         = 'New';
    // public const SUPPORT_TICKET_STATUS_IN_PROGRESS = 'In Progress';
    // public const SUPPORT_TICKET_STATUS_SOLVED      = 'Solved';
    // public const SUPPORT_TICKET_STATUS_CLOSED      = 'Closed';
    // public const SUPPORT_TICKET_STATUS_RE_ASSIGNED = 'Re-Assigned';
    // public const SUPPORT_TICKET_STATUS_ANSWERED    = 'Answered';

    // public static $statusOptions = [
    //     self::SUPPORT_TICKET_STATUS_NEW,
    //     self::SUPPORT_TICKET_STATUS_IN_PROGRESS,
    //     self::SUPPORT_TICKET_STATUS_SOLVED,
    //     self::SUPPORT_TICKET_STATUS_CLOSED,
    //     // self::SUPPORT_TICKET_STATUS_RE_ASSIGNED,
    //     // self::SUPPORT_TICKET_STATUS_ANSWERED,
    // ];

    // public static $openStatuses = [
    //     SupportTicket::SUPPORT_TICKET_STATUS_NEW,
    //     SupportTicket::SUPPORT_TICKET_STATUS_IN_PROGRESS,
    //     // SupportTicket::SUPPORT_TICKET_STATUS_RE_ASSIGNED,
    //     // SupportTicket::SUPPORT_TICKET_STATUS_ANSWERED,
    // ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(SupportTicketObserver::class);

        // static::saving(function (SupportTicket $element) { });
        // static::creating(function (SupportTicket $element) { });
        // static::updating(function (SupportTicket $element) { });
        // static::created(function (SupportTicket $element) { });
        // static::updated(function (SupportTicket $element) { });
        // static::saved(function (SupportTicket $element) { });
        // static::deleting(function (SupportTicket $element) { });
        // static::deleted(function (SupportTicket $element) { });
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
     * @return SupportTicketProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
