<?php

namespace App\Mainframe\Modules\Reports;

use App\Mainframe\Modules\Reports\Traits\ReportViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class ReportViewProcessor extends BaseModuleViewProcessor
{
    use ReportViewProcessorTrait;
}
