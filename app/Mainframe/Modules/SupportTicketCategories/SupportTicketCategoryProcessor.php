<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SupportTicketCategoryProcessor extends ModelProcessor
{
    use SupportTicketCategoryProcessorTrait;
}
