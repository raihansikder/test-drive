<?php

namespace App\Mainframe\Modules\Projects;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Projects\Traits\ProjectProcessorTrait;

class ProjectProcessor extends ModelProcessor
{
    use ProjectProcessorTrait;
}
