<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class SupportTicketTagController extends ModularController
{
    use SupportTicketTagControllerTrait;
}
