<?php

namespace App\Project\Features\Modular\ModularController;

use App\Project\Features\Report\ModuleList;
use App\Project\Http\Controllers\BaseController;
use App\Project\Features\Report\ModuleReportBuilder;
use App\Mainframe\Features\Modular\ModularController\Traits\Resolvable;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestValidator;
use App\Mainframe\Features\Modular\ModularController\Traits\RequestProcessorTrait;
use App\Mainframe\Features\Modular\ModularController\Traits\ModularControllerTrait;

class ModularController extends BaseController
{
    use RequestValidator,
        RequestProcessorTrait,
        Resolvable,
        ModularControllerTrait;

    public function __construct()
    {
        parent::__construct();
        $this->initModularController();
    }

    /**
     * Show and render report
     *
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|\Illuminate\View\View|mixed
     * @throws \Exception
     */
    public function report()
    {
        if (!user()->can('view-report', $this->model)) {
            return $this->permissionDenied();
        }

        return (new ModuleReportBuilder($this->module))->output(); // Utilize project asset instead of Mainframe
    }

    /**
     * Returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function listJson()
    {
        return (new ModuleList($this->module))->json(); // Utilize project asset instead of Mainframe
    }

}
