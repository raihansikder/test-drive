<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Modular\BaseModule\BaseModuleObserver;
use App\Mainframe\Modules\Countries\Traits\CountryObserverTrait;

class CountryObserver extends BaseModuleObserver
{
    use CountryObserverTrait;
}
