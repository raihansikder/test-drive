<?php

namespace App\Project\Modules\Spreads;

use App\Project\Features\Report\ModuleList;

class SpreadController extends \App\Mainframe\Modules\Spreads\SpreadController
{
    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'spreads';
    /** @var Spread */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * Spread Datatable
     *
     * @return SpreadDatatable
     */
    public function datatable()
    {
        return new SpreadDatatable($this->module);
    }

    /**
     * List Spread
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
