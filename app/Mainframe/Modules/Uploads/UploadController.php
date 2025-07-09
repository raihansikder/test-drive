<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class UploadController extends ModularController
{
    use UploadControllerTrait;

    /** @var \App\Upload */
    public $element;
}
