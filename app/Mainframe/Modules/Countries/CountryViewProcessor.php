<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\Countries\Traits\CountryViewProcessorTrait;

class CountryViewProcessor extends BaseModuleViewProcessor
{
    use CountryViewProcessorTrait;
}
