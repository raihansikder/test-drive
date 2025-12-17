<?php

namespace App\Mainframe\Features\Report;

use App\Mainframe\Features\Report\Traits\ModuleReportBuilderTrait;
use App\Module;

class ModuleReportBuilder extends ReportBuilder
{
    use ModuleReportBuilderTrait;

    /**
     * Create a new ModuleReportBuilder instance.
     *
     * @param  Module|mixed  $module  Module instance or module name
     * @param  string|null  $dataSource  Data source for the report
     * @param  string|null  $path  Path to store the report
     * @param  int|null  $cache  Cache duration in minutes
     */
    public function __construct($module = null, $dataSource = null, $path = null, $cache = null)
    {
        $this->setModule($module ?: $this->moduleName);
        $this->enableAutoRun();
        parent::__construct($dataSource, $path, $cache);
    }
}
