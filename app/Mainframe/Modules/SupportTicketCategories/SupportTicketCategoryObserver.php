<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SupportTicketCategoryObserver extends BaseModuleObserver
{
    use SupportTicketCategoryObserverTrait;
}
