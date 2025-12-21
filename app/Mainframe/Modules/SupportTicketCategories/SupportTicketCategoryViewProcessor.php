<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class SupportTicketCategoryViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketCategoryViewProcessorTrait;
}
