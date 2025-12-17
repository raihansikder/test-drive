<?php

namespace App\Mainframe\Modules\Projects;

use App\Mainframe\Modules\Projects\Traits\ProjectViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class ProjectViewProcessor extends BaseModuleViewProcessor
{
    use ProjectViewProcessorTrait;
}
