<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryObserverTrait;

class SupportTicketCategoryObserver extends BaseModuleObserver
{
    use SupportTicketCategoryObserverTrait;
}
