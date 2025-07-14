<?php

namespace App\Project\Modules\MqttMessages;

use App\Project\Features\Report\ModuleReportBuilder;

class MqttMessageReport extends ModuleReportBuilder
{
    public $moduleName = 'mqtt-messages';

    /** @var  string Directory location of the report blade templates */

    public $path = 'project.layouts.report';

    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext'];

}
