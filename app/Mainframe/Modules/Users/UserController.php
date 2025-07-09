<?php

namespace App\Mainframe\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class UserController extends ModularController
{
    use UserControllerTrait;
}
