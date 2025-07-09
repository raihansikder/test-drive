<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagObserverTrait;

class SupportTicketTagObserver extends BaseModuleObserver
{
    use SupportTicketTagObserverTrait;
}
