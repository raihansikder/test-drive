<?php

namespace App\Project\Modules\ModuleGroups;

use App\Project\Features\Report\ModuleList;

class ModuleGroupController extends \App\Mainframe\Modules\ModuleGroups\ModuleGroupController
{
    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'module-groups';
    /** @var ModuleGroup */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * ModuleGroup Datatable
     *
     * @return ModuleGroupDatatable
     */
    public function datatable()
    {
        return new ModuleGroupDatatable($this->module);
    }

    /**
     * List ModuleGroup
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
