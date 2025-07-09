<?php

namespace App\Project\Modules\Users;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

class UserController extends \App\Mainframe\Modules\Users\UserController
{
    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'users';

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */

    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        if (!$this->user->can('view-any', $this->model)) {
            return $this->permissionDenied();
        }

        # Respond as API with custom model resource collection
        if ($this->isApiCall()) {
            return (new UserList())->json(UserCollection::class);
        }

        # Respond as generic JSON with all fields
        if ($this->expectsJson()) {
            return $this->listJson();
        }

        # Show default module grid
        $this->view->setType('index')->setDatatable($this->datatable());

        return $this->view($this->view->gridPath());
    }

    /**
     * Show create form.
     *
     * @return View|JsonResponse
     * @throws Exception
     */
    public function create()
    {
        return parent::create();
    }

    /**
     * Store
     *
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        return parent::store($request);
    }

    /**
     * Show
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @urlParam  id required The ID of the item.
     * @throws Exception
     */
    public function show($id)
    {
        # Get the element
        if (!$this->element = $this->model->with($this->relationsFromRequest())->find($id)) {
            return $this->notFound();
        }

        # Check permission
        if (!$this->user->can('view', $this->element)) {
            return $this->permissionDenied();
        }

        # Send API response
        if ($this->isApiCall()) {
            return $this->load(new UserResource($this->element))->json();
        }

        # Redirect to edit page
        return $this->load($this->element)
            ->to(route($this->moduleName.'.edit', $id))
            ->send();

    }

    /**
     * Show edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View|JsonResponse
     */
    public function edit($id)
    {
        return parent::edit($id);
    }

    /**
     * Update
     *
     * @param  Request  $request
     * @param $id
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    /**
     * Delete
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        return parent::destroy($id);
    }

    /**
     * Restore a soft-deleted item
     *
     * @param  null  $id
     * @return void
     */
    public function restore($id = null)
    {
        return parent::restore($id);
    }

    /**
     * User Datatable
     *
     * @return UserDatatable
     */
    public function datatable()
    {
        return new UserDatatable($this->module);
    }

    /**
     * List User
     * Returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function listJson()
    {
        return (new UserList())->json();
    }

    /**
     * Module Report
     *
     * @return bool|Factory|JsonResponse|Collection|\Illuminate\View\View|mixed
     * @throws Exception
     */
    public function report()
    {

        if (!user()->can('view-report', $this->model)) {
            return $this->permissionDenied();
        }

        // Todo: Create  custom report for this module
        return (new UserReport())->output(); // Utilize project asset instead of Mainframe
    }


    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */

    // public function transformInputRequests() { }
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
    |
    */

}
