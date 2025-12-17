<?php

namespace App\Mainframe\Modules\Countries;

use App\Mainframe\Modules\Countries\Traits\CountryProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class CountryProcessor extends ModelProcessor
{
    use CountryProcessorTrait;
}
