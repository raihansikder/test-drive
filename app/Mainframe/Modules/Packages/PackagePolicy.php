<?php

namespace App\Mainframe\Modules\Packages;

use App\Mainframe\Modules\Packages\Traits\PackagePolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class PackagePolicy extends BaseModulePolicy
{
    use PackagePolicyTrait;
}
