<?php

namespace App\Mainframe\Modules\Spreads;

use App\Mainframe\Modules\Spreads\Traits\SpreadProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SpreadProcessor extends ModelProcessor
{
    use SpreadProcessorTrait;
}
