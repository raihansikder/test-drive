<?php

namespace App\Mainframe\Modules\Groups;

use App\Mainframe\Modules\Groups\Traits\GroupProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class GroupProcessor extends ModelProcessor
{
    use GroupProcessorTrait;
}
