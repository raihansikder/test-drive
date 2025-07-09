<?php

namespace App\Mainframe\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class UploadObserver extends BaseModuleObserver
{
    use UploadObserverTrait;
}
