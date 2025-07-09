<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryProcessorTrait;

class SupportTicketCategoryProcessor extends ModelProcessor
{
    use SupportTicketCategoryProcessorTrait;
}
