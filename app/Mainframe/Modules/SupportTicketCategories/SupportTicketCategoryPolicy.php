<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryPolicyTrait;

class SupportTicketCategoryPolicy extends BaseModulePolicy
{
    use SupportTicketCategoryPolicyTrait;
}
