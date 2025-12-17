<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class SupportTicketController extends ModularController
{
    use SupportTicketControllerTrait;
}
