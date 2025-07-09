<?php

namespace App\Mainframe\Reports;

use App\Module;
use App\Mainframe\Features\Report\ReportBuilder;
use App\Mainframe\Features\Report\Traits\ModuleReportBuilderTrait;

class ActiveUsers extends ReportBuilder
{
    use ModuleReportBuilderTrait;

    public function __construct()
    {
        $this->module = Module::byName('users');
        $this->model = $this->module->modelInstance();
        $this->dataSource = 'users';

        parent::__construct();
    }

}
