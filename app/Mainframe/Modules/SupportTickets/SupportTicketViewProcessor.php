<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketViewProcessorTrait;

class SupportTicketViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketViewProcessorTrait;
}
