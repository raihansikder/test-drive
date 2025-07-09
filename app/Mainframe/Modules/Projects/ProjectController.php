<?php

namespace App\Mainframe\Modules\Projects;

use App\Mainframe\Modules\Projects\Traits\ProjectControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class ProjectController extends ModularController
{
    use ProjectControllerTrait;
}
