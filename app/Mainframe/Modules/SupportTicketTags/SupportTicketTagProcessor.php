<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SupportTicketTagProcessor extends ModelProcessor
{
    use SupportTicketTagProcessorTrait;
}
