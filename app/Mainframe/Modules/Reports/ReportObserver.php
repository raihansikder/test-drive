<?php

namespace App\Mainframe\Modules\Reports;

use App\Mainframe\Modules\Reports\Traits\ReportObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class ReportObserver extends BaseModuleObserver
{
    use ReportObserverTrait;
}
