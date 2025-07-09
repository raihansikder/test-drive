<?php

namespace App\Mainframe\Http\Controllers\Api;

use App\Mainframe\Http\Controllers\BaseController;
use App\Mainframe\Http\Controllers\Api\Traits\ApiControllerTrait;

class ApiController extends BaseController
{
    use ApiControllerTrait;

    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user->refresh(); // Useful for bearer because token may get updated.
        $this->injectUserIdentityInRequest();

    }

}
