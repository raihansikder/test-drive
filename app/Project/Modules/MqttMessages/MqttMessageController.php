<?php

namespace App\Project\Modules\MqttMessages;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Project\Features\Modular\ModularController\ModularController;

class MqttMessageController extends ModularController
{
    /*
    |--------------------------------------------------------------------------
    | Section: Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'mqtt-messages';
    /** @var MqttMessage */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * Index MqttMessages
     *
     * @return Factory|JsonResponse|View
     * @throws Exception
     */
    public function index()
    {
        if (!$this->user->can('view-any', $this->model)) {
            return $this->permissionDenied();
        }

        # Respond as API with custom model resource collection
        if ($this->isApiCall()) {
            return (new MqttMessageList())->json(MqttMessageCollection::class);
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
     * Show MqttMessage create form.
     *
     * @return \Illuminate\Contracts\View\View|JsonResponse
     * @throws Exception
     */
    public function create()
    {
        return parent::create();
    }

    /**
     * Store a new MqttMessage
     *
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        return parent::store($request);
    }

    /**
     * Show an existing MqttMessage
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
            return $this->load(new MqttMessageResource($this->element))->json();
        }

        # Redirect to edit page
        return $this->load($this->element)
            ->to(route($this->moduleName.'.edit', $id))
            ->send();

    }

    /**
     * Show MqttMessage edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View|JsonResponse
     */
    public function edit($id)
    {
        return parent::edit($id);
    }

    /**
     * Update an existing MqttMessage
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
     * Delete an existing MqttMessage
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
     * Restore a soft-deleted MqttMessage
     *
     * @param  null  $id
     * @return void
     */
    public function restore($id = null)
    {
        return parent::restore($id);
    }

    /**
     * MqttMessage Datatable to show in module grid
     *
     * @return MqttMessageDatatable
     */
    public function datatable()
    {
        return new MqttMessageDatatable($this->module);
    }

    /**
     * List returns a collection of MqttMessages as JSON
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function listJson()
    {
        return (new MqttMessageList())->json();
    }

    /**
     * MqttMessages Report
     *
     * @return Factory|JsonResponse|View
     * @throws Exception
     */
    public function report()
    {
        if (!user()->can('view-report', $this->model)) {
            return $this->permissionDenied();
        }
         // Create a custom report for this module
        return (new MqttMessageReport())->output();
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
    */

}
