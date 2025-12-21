<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class SupportTicketCategoryPolicy extends BaseModulePolicy
{
    use SupportTicketCategoryPolicyTrait;
}
