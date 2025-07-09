<?php

namespace App\Mainframe\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class UserViewProcessor extends BaseModuleViewProcessor
{
    use UserViewProcessorTrait;
}
