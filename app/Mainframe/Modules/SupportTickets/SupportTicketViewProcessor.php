<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class SupportTicketViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketViewProcessorTrait;
}
