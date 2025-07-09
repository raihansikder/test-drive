<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class EmailController extends ModularController
{
    use EmailControllerTrait;
}
