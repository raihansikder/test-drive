<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class EmailViewProcessor extends BaseModuleViewProcessor
{
    use EmailViewProcessorTrait;
}
