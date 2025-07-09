<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagViewProcessorTrait;

class SupportTicketTagViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketTagViewProcessorTrait;
}
