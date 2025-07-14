<?php

namespace App\Project\Modules\MqttMessages;

use App\Project\Features\Report\ModuleReportBuilder;

class MqttMessageList extends ModuleReportBuilder
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

    public $moduleName = 'mqtt-messages';

    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext'];


}
