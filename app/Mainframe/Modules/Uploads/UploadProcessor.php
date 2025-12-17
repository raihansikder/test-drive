<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class UploadProcessor extends ModelProcessor
{
    use UploadProcessorTrait;
}
