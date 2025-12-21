<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class SupportTicketTagPolicy extends BaseModulePolicy
{
    use SupportTicketTagPolicyTrait;
}
