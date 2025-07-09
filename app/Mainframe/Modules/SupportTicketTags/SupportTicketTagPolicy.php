<?php

namespace App\Mainframe\Modules\SupportTicketTags;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\SupportTicketTags\Traits\SupportTicketTagPolicyTrait;

class SupportTicketTagPolicy extends BaseModulePolicy
{
    use SupportTicketTagPolicyTrait;
}
