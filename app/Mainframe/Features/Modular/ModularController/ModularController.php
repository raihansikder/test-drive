<?php

namespace App\Mainframe\Features\Modular\ModularController;

use App\Mainframe\Http\Controllers\BaseController;
use App\Mainframe\Features\Modular\ModularController\Traits\Resolvable;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestValidator;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestProcessorTrait;
use App\Mainframe\Features\Modular\ModularController\Traits\ModularControllerTrait;

class ModularController extends BaseController
{
    use RequestValidator, RequestProcessorTrait, Resolvable, ModularControllerTrait;

    /**
     * ModularController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initModularController();
    }

}
