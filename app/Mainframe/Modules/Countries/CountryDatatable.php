<?php

namespace App\Mainframe\Modules\Countries;

use App\Mainframe\Modules\Countries\Traits\CountryDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class CountryDatatable extends ModuleDatatable
{
    use CountryDatatableTrait;
}
