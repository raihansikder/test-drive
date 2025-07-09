<?php

namespace App\Project\Modules\Users;

use App\Project\Features\Report\ModuleReportBuilder;

class UserList extends ModuleReportBuilder
{
    /*
    |--------------------------------------------------------------------------
    | Note: Implementation
    |--------------------------------------------------------------------------
    | This is a report builder that by default extends ModuleReportBuilder.
    | Purpose of this is:
    | - serves a JSON list for the URL: /<module>/list/json & /<module>?ret=json
    |
    */

    public $moduleName = 'users';

    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext', 'email', 'first_name', 'last_name'];


}
