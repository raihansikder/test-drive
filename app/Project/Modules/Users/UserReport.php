<?php

namespace App\Project\Modules\Users;

use App\Project\Features\Report\ModuleReportBuilder;

class UserReport extends ModuleReportBuilder
{
    public $moduleName = 'users';

    /** @var  string Directory location of the report blade templates */

    public $path = 'project.layouts.report';

    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext'];


}
