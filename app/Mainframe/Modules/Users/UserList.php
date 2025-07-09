<?php

namespace App\Mainframe\Modules\Users;

use App\Project\Features\Report\ModuleReportBuilder;

class UserList extends ModuleReportBuilder
{

    public $moduleName = 'users';

    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext', 'email', 'first_name', 'last_name'];
}
