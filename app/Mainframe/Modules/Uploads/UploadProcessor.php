<?php

namespace App\Mainframe\Modules\Uploads;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Uploads\Traits\UploadProcessorTrait;

class UploadProcessor extends ModelProcessor
{
    use UploadProcessorTrait;
}
