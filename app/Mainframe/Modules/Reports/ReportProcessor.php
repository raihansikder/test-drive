<?php

namespace App\Mainframe\Modules\Reports;

use App\Mainframe\Modules\Reports\Traits\ReportProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class ReportProcessor extends ModelProcessor
{
    use ReportProcessorTrait;
}
