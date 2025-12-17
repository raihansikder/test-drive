<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class SupportTicketDatatable extends ModuleDatatable
{
    use SupportTicketDatatableTrait;
}
