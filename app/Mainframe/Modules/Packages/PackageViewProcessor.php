<?php

namespace App\Mainframe\Modules\Packages;

use App\Mainframe\Modules\Packages\Traits\PackageViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class PackageViewProcessor extends BaseModuleViewProcessor
{
    use PackageViewProcessorTrait;
}
