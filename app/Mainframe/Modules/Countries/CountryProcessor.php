<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Countries\Traits\CountryProcessorTrait;

class CountryProcessor extends ModelProcessor
{
    use CountryProcessorTrait;
}
