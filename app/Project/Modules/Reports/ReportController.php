<?php

namespace App\Project\Modules\Reports;

use App\Project\Features\Report\ModuleList;

class ReportController extends \App\Mainframe\Modules\Reports\ReportController
{
    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'reports';
    /** @var Report */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * Report Datatable
     *
     * @return ReportDatatable
     */
    public function datatable()
    {
        return new ReportDatatable($this->module);
    }

    /**
     * List Report
     * Returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function listJson()
    {
        return (new ModuleList($this->module))->json();
    }

    // public function report() { }

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
