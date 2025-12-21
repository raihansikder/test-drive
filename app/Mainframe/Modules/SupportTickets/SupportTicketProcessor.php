<?php

namespace App\Mainframe\Modules\SupportTickets;

use App\Mainframe\Modules\SupportTickets\Traits\SupportTicketProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SupportTicketProcessor extends ModelProcessor
{
    use SupportTicketProcessorTrait;

    // public $immutables;
    // public $transitions; // Note: Also you can define in transitions() below
    // public $trackedFields;

}
