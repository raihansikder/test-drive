<?php

namespace App\Mainframe\Modules\Settings;

use App\Mainframe\Modules\Settings\Traits\SettingObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class SettingObserver extends BaseModuleObserver
{
    use SettingObserverTrait;
}
