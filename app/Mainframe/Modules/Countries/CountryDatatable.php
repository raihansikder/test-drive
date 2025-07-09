<?php

namespace App\Mainframe\Modules\Countries;

use App\Project\Features\Datatable\ModuleDatatable;
use App\Mainframe\Modules\Countries\Traits\CountryDatatableTrait;

class CountryDatatable extends ModuleDatatable
{
    use CountryDatatableTrait;
}
