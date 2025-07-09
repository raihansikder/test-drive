<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Modular\BaseModule\BaseModulePolicy;
use App\Mainframe\Modules\Countries\Traits\CountryPolicyTrait;

class CountryPolicy extends BaseModulePolicy
{
    use CountryPolicyTrait;
}
