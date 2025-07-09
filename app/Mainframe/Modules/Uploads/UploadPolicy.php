<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class UploadPolicy extends BaseModulePolicy
{
    use UploadPolicyTrait;
}
