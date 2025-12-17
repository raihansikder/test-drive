<?php

namespace App\Mainframe\Modules\Assignments;

use App\Mainframe\Modules\Assignments\Traits\AssignmentControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class AssignmentController extends ModularController
{
    use AssignmentControllerTrait;
}
