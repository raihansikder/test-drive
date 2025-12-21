<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SupportTicketTagObserver extends BaseModuleObserver
{
    use SupportTicketTagObserverTrait;
}
