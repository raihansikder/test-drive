<?php

namespace App\Mainframe\Modules\Countries;

use App\Mainframe\Modules\Countries\Traits\CountryObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class CountryObserver extends BaseModuleObserver
{
    use CountryObserverTrait;
}
