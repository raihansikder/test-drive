<?php

namespace App\Mainframe\Modules\Assignments;

use App\Mainframe\Modules\Assignments\Traits\AssignmentProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class AssignmentProcessor extends ModelProcessor
{
    use AssignmentProcessorTrait;
}
