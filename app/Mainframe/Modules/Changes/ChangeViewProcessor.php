<?php

namespace App\Mainframe\Modules\Changes;

use App\Mainframe\Modules\Changes\Traits\ChangeViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class ChangeViewProcessor extends BaseModuleViewProcessor
{
    use ChangeViewProcessorTrait;
}
