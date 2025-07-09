<?php

namespace App\Mainframe\Modules\Changes;

use App\Mainframe\Modules\Changes\Traits\ChangePolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class ChangePolicy extends BaseModulePolicy
{
    use ChangePolicyTrait;
}
