<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class SupportTicketTagViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketTagViewProcessorTrait;
}
