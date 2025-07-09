<?php /** @noinspection SenselessProxyMethodInspection */

namespace App\Mainframe\Modules\Settings;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Settings\Traits\SettingProcessorTrait;

class SettingProcessor extends ModelProcessor
{
    use SettingProcessorTrait;

    public $immutables = ['name'];
    public $trackedFields = ['value'];
}
