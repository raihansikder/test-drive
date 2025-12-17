<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class EmailDatatable extends ModuleDatatable
{
    use EmailDatatableTrait;
}
