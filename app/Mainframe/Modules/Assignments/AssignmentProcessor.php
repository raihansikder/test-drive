<?php

namespace App\Mainframe\Modules\Assignments;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Assignments\Traits\AssignmentProcessorTrait;

class AssignmentProcessor extends ModelProcessor
{
    use AssignmentProcessorTrait;
}
