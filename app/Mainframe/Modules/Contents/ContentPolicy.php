<?php

namespace App\Mainframe\Modules\Contents;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\Contents\Traits\ContentPolicyTrait;

class ContentPolicy extends BaseModulePolicy
{
    use ContentPolicyTrait;
}
