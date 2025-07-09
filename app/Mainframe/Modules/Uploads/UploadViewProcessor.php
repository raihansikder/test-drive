<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class UploadViewProcessor extends BaseModuleViewProcessor
{
    use UploadViewProcessorTrait;
}
