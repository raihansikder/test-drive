<?php

namespace App\Mainframe\Features\Modular\ModularController;

use App\Mainframe\Features\Modular\ModularController\Traits\ModularControllerTrait;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestProcessorTrait;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestValidator;
use App\Mainframe\Features\Modular\ModularController\Traits\Resolvable;
use App\Mainframe\Http\Controllers\BaseController;

class ModularController extends BaseController
{
    use ModularControllerTrait, RequestProcessorTrait, RequestValidator, Resolvable;

    /**
     * ModularController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initModularController();
    }
}
