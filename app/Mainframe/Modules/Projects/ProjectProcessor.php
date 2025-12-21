<?php

namespace App\Mainframe\Modules\Projects;

use App\Mainframe\Modules\Projects\Traits\ProjectProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class ProjectProcessor extends ModelProcessor
{
    use ProjectProcessorTrait;
}
