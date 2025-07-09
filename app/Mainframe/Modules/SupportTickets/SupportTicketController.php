<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Project\Features\Modular\ModularController\ModularController;
use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketControllerTrait;

class SupportTicketController extends ModularController
{
    use SupportTicketControllerTrait;
}
