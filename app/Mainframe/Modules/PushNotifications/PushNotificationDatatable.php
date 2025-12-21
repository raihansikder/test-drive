<?php

namespace App\Mainframe\Modules\PushNotifications;

use App\Mainframe\Modules\PushNotifications\Traits\PushNotificationDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class PushNotificationDatatable extends ModuleDatatable
{
    use PushNotificationDatatableTrait;
}
