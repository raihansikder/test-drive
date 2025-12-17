<?php

namespace App\Mainframe\Modules\Packages;

use App\Mainframe\Modules\Packages\Traits\PackageProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class PackageProcessor extends ModelProcessor
{
    use PackageProcessorTrait;
}
