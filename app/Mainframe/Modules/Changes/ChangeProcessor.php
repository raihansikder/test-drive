<?php

namespace App\Mainframe\Modules\Changes;

use App\Mainframe\Modules\Changes\Traits\ChangeProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class ChangeProcessor extends ModelProcessor
{
    use ChangeProcessorTrait;
}
