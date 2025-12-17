<?php

namespace App\Mainframe\Modules\Assignments;

use App\Mainframe\Modules\Assignments\Traits\AssignmentViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class AssignmentViewProcessor extends BaseModuleViewProcessor
{
    use AssignmentViewProcessorTrait;
}
