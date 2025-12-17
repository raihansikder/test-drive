<?php

namespace App\Mainframe\Modules\Contents;

use App\Mainframe\Modules\Contents\Traits\ContentPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class ContentPolicy extends BaseModulePolicy
{
    use ContentPolicyTrait;
}
