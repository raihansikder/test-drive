<?php

namespace App\Mainframe\Modules\Countries;

use App\Mainframe\Modules\Countries\Traits\CountryViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class CountryViewProcessor extends BaseModuleViewProcessor
{
    use CountryViewProcessorTrait;
}
