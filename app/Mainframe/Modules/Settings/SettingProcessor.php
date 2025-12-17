<?php

/** @noinspection SenselessProxyMethodInspection */

namespace App\Mainframe\Modules\Settings;

use App\Mainframe\Modules\Settings\Traits\SettingProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class SettingProcessor extends ModelProcessor
{
    use SettingProcessorTrait;

    public $immutables = ['name'];

    public $trackedFields = ['value'];
}
