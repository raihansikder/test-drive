<?php

namespace App\Mainframe\Modules\Contents;

use App\Mainframe\Modules\Contents\Traits\ContentViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class ContentViewProcessor extends BaseModuleViewProcessor
{
    use ContentViewProcessorTrait;
}
