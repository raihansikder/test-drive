<?php

namespace App\Mainframe\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class UserDatatable extends ModuleDatatable
{
    use UserDatatableTrait;

    // public $hidden = ['id'];
}
