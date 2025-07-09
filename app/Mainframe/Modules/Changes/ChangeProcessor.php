<?php

namespace App\Mainframe\Modules\Changes;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Changes\Traits\ChangeProcessorTrait;

class ChangeProcessor extends ModelProcessor
{
    use ChangeProcessorTrait;
}
