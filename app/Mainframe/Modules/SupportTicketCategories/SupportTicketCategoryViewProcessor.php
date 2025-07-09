<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryViewProcessorTrait;

class SupportTicketCategoryViewProcessor extends BaseModuleViewProcessor
{
    use SupportTicketCategoryViewProcessorTrait;
}
