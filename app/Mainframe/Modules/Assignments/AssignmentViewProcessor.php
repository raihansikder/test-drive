<?php

namespace App\Mainframe\Modules\Assignments;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\Assignments\Traits\AssignmentViewProcessorTrait;

class AssignmentViewProcessor extends BaseModuleViewProcessor
{
    use AssignmentViewProcessorTrait;
}
