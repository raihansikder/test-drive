<?php

namespace App\Mainframe\Modules\Countries;

use App\Mainframe\Modules\Countries\Traits\CountryControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class CountryController extends ModularController
{
    use CountryControllerTrait;
}
