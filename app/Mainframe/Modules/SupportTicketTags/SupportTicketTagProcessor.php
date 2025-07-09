<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagProcessorTrait;

class SupportTicketTagProcessor extends ModelProcessor
{
    use SupportTicketTagProcessorTrait;
}
