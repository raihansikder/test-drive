<?php

namespace App\Mainframe\Modules\Projects\Traits;

use App\Project\Features\Report\ModuleList;
use App\Project\Modules\Projects\ProjectDatatable;

/** @mixin \App\Mainframe\Modules\Projects\ProjectController */
trait ProjectControllerTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */

    /**
     * Datatable
     *
     * @return ProjectDatatable
     */
    public function datatable()
    {
        return new ProjectDatatable($this->module);
    }

    /**
     * List returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function listJson()
    {
        return (new ModuleList($this->module))->json();
    }

    /**
     * Module Report
     *
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|\Illuminate\View\View|mixed
     * @throws \Exception
     */
    // public function report()
    // {
    //     if (!user()->can('view-report', $this->model)) {
    //         return $this->permissionDenied();
    //     }
    //     // Todo: Create  custom report for this module
    //     return (new ProjectReport($this->module))->output(); // Utilize project asset instead of Mainframe
    // }

    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */
    // public function storeRequestValidator() { }
    // public function updateRequestValidator() { }
    // public function saveRequestValidator() { }
    // public function attemptStore() { }
    // public function attemptUpdate() { }
    // public function attemptDestroy() { }
    // public function stored() { }
    // public function updated() { }
    // public function saved() { }
    // public function deleted() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Custom Controller functions
    |--------------------------------------------------------------------------
    | Write down additional controller functions that might be required for your project to handle business logic
    */
}
