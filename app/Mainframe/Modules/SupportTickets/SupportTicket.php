<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\SupportTicketTag;
use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketTrait;

class SupportTicket extends BaseModule
{
    use SupportTicketTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'name_ext',
        // 'division_id',
        //'division_name',
        // 'district_id',
        //'district_name',
        // 'upazila_id',
        //'upazila_name',
        'user_id',
        'details',
        'contact_no',
        'primary_category_id',
        //'primary_category_name',
        'secondary_category_id',
        //'secondary_category_name',
        'support_ticket_tag_ids',
        'support_ticket_tag_names',
        'support_ticket_tag_names_formatted',
        'status_name',
        'reviewers_note',
        'slug',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'support_ticket_tag_ids' => 'array',
        'support_ticket_tag_names' => 'array',
    ];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!
    protected $spreadFields = [
        'support_ticket_tag_ids' => SupportTicketTag::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    public const SUPPORT_TICKET_STATUS_NEW         = 'New';
    public const SUPPORT_TICKET_STATUS_IN_PROGRESS = 'In Progress';
    public const SUPPORT_TICKET_STATUS_SOLVED      = 'Solved';
    public const SUPPORT_TICKET_STATUS_CLOSED      = 'Closed';
    public const SUPPORT_TICKET_STATUS_RE_ASSIGNED = 'Re-Assigned';
    public const SUPPORT_TICKET_STATUS_ANSWERED    = 'Answered';

    public static $statusOptions = [
        self::SUPPORT_TICKET_STATUS_NEW,
        self::SUPPORT_TICKET_STATUS_IN_PROGRESS,
        self::SUPPORT_TICKET_STATUS_SOLVED,
        self::SUPPORT_TICKET_STATUS_CLOSED,
        self::SUPPORT_TICKET_STATUS_RE_ASSIGNED,
        self::SUPPORT_TICKET_STATUS_ANSWERED,
    ];

    public static $openStatuses = [
        SupportTicket::SUPPORT_TICKET_STATUS_NEW,
        SupportTicket::SUPPORT_TICKET_STATUS_IN_PROGRESS,
        SupportTicket::SUPPORT_TICKET_STATUS_RE_ASSIGNED,
        SupportTicket::SUPPORT_TICKET_STATUS_ANSWERED,
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */

}
