<?php /** @noinspection PhpRedundantOptionalArgumentInspection */

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Mainframe\Features\Modular\ModularController\Traits;

use Arr;
use View;
use Throwable;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Project\Features\Report\ModuleList;
use App\Project\Modules\Uploads\UploadController;
use App\Mainframe\Features\Datatable\ModuleDatatable;
use App\Mainframe\Modules\Comments\CommentController;
use App\Mainframe\Features\Report\ModuleReportBuilder;
use App\Mainframe\Modules\SuperHeroes\SuperHeroResource;
use App\Mainframe\Features\Modular\ModularController\ModularController;

/** @mixin ModularController */
trait ModularControllerTrait
{
    /**
     * Initialize modular controller
     */
    public function initModularController()
    {
        // Load
        $this->module = Module::byName($this->moduleName);
        $this->model = $this->module->modelInstance();
        $this->view = $this->viewProcessor()->setModule($this->module)->setModel($this->model);

        // Sometimes the wet element is shared back as payload on validation fail on store/update etc.
        // We can use that wet model instead of relying on request()->old();
        $payload = session('payload');
        if ($payload instanceof $this->model) {
            $this->element = $payload;
        }

        // Share these variables in  all views
        View::share([
            'module' => $this->module,
            'model' => $this->model,
            'view' => $this->view,
        ]);

    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        if (!$this->user->can('view-any', $this->model)) {
            return $this->permissionDenied();
        }

        # Respond as JSON/API
        if ($this->expectsJson()) {
            return $this->listJson();
        }

        # Show default module grid
        $this->view->setType('index')->setDatatable($this->datatable());

        return $this->view($this->view->gridPath());
    }

    /**
     * Store
     *
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     * @noinspection PhpUnusedParameterInspection
     */
    public function store(Request $request)
    {
        if (!$this->user->can('create', $this->model)) {
            return $this->permissionDenied();
        }

        $this->element = $this->model; // Create an empty model to be stored.

        // $this->attemptStore();
        try {
            $this->attemptStore();
        } catch (Throwable $e) {
            report($e);
            $this->errorException($e);
        }

        return $this->load($this->element)->send();
    }

    /**
     * Show
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @urlParam  id required The ID of the item.
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

        // # Send API response
        // if ($this->isApiCall()) {
        //     return $this->load(new SuperHeroResource($this->element))->json();
        // }

        # Redirect to edit page
        return $this->load($this->element)
            ->to(route($this->moduleName.'.edit', $id))
            ->send();

    }

    /**
     * Show create form.
     *
     * @return \Illuminate\Contracts\View\View|JsonResponse
     * @throws \Exception
     */
    public function create()
    {
        # Fill the model
        $this->element = $this->element ?: $this->model->fill(request()->all());
        $this->element->uuid = $this->uuid();
        $this->element->is_active = 1; // Note: Set to active by default while creating

        # Check permission
        if (!$this->user->can('create', $this->element)) {
            return $this->permissionDenied();
        }

        # Set view processor attributes
        $this->view->setType('create')->setElement($this->element);

        # Load view with view vars
        return $this->view($this->view->formPath('create'))
            ->with($this->view->varsCreate());
    }

    /**
     * Show edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View|JsonResponse
     */
    public function edit($id)
    {
        # Get the element
        if (!$this->element = $this->model->find($id)) {
            return $this->notFound();
        }

        # Check permission
        if (!$this->user->can('view', $this->element)) {
            return $this->permissionDenied();
        }

        # Set view processor attributes
        $this->view->setType('edit')
            ->setElement($this->element)
            ->addImmutables($this->element->processor()->getImmutables());

        # Load view with view vars
        return $this->view($this->view->formPath('edit'))
            ->with($this->view->viewVarsEdit());
    }

    /**
     * Update
     *
     * @param  Request  $request
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @noinspection PhpUnusedParameterInspection
     */
    public function update(Request $request, $id)
    {
        if (!$this->element = $this->model->find($id)) {
            return $this->notFound();
        }

        if ($this->user->cannot('update', $this->element)) {
            return $this->permissionDenied();
        }

        try {
            $this->attemptUpdate();
        } catch (Throwable $e) {
            report($e);
            $this->errorException($e);
        }

        return $this->load($this->element)->send();
    }

    /**
     * Delete
     *
     * @param $id
     * @return JsonResponse|RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (!$this->element = $this->model->find($id)) {
            return $this->notFound();
        }

        if ($this->user->cannot('delete', $this->element)) {
            return $this->permissionDenied();
        }

        try {
            $this->attemptDestroy();
        } catch (Throwable $e) {
            report($e);
            $this->errorException($e);
        }

        return $this->load($this->element)->send();
    }

    /**
     * Restore a soft-deleted item
     *
     * @param  null  $id
     * @return void
     * @noinspection PhpUnusedParameterInspection
     */
    public function restore($id = null)
    {
        abort(403, 'Restore restricted');
    }

    /**
     * Clone an element. Post the form data into a new create form for user action
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|RedirectResponse|\Illuminate\View\View|void
     */
    public function clone($id)
    {
        if (!$this->user->can('create', $this->model)) {
            return $this->permissionDenied();
        }

        $this->element = $this->model->findOrFail($id)->replicate(); // Create a clone
        $this->element->uuid = uuid(); // Set a fresh new uuid
        // URL + params to post the new value

        $to = route($this->moduleName.'.create', $this->element->toArray());

        return $this->to($to)->load($this->element)->send();
    }

    /**
     * List
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function listJson()
    {
        return (new ModuleList($this->module))->json();
    }

    /**
     * Resolve which Datatable class to use.
     *
     * @return \App\Mainframe\Features\Datatable\Datatable
     */
    public function datatable()
    {
        return new ModuleDatatable($this->module);
    }

    /**
     * Show and render report
     *
     * @return bool|\Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\Support\Collection|\Illuminate\View\View|mixed
     * @throws \Exception
     */
    public function report()
    {
        if (!$this->user->can('view-report', $this->model)) {
            return $this->permissionDenied();
        }

        return (new ModuleReportBuilder($this->module))->output();
    }

    /**
     * Returns datatable json for the module index page
     * A route is automatically created for all modules to access this controller function
     *
     * @return JsonResponse
     * @var \Yajra\DataTables\DataTables $dt
     */
    public function datatableJson()
    {
        return ($this->datatable())->json();
    }

    /**
     * Get all the uploads of an element
     *
     * @param  null  $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function uploads($id)
    {
        request()->merge([
            'module_id' => $this->module->id,
            'element_id' => $id,
        ]);

        return app(UploadController::class)->listJson();
    }

    /**
     * Uploads files under an element
     *
     * @param  null  $id
     * @return ModularController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @noinspection PhpUnused
     */
    public function attachUpload($id)
    {
        request()->merge([
            'module_id' => $this->module->id,
            'element_id' => $id,
        ]);

        return app(UploadController::class)->store(request());
    }

    /**
     * Show all the changes/change logs of an item
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View|void
     * @throws \Exception
     */
    public function changes($id)
    {

        if (!$this->element = $this->model->find($id)) {
            return $this->notFound();
        }

        if (!$this->user->can('view', $this->element)) {
            return $this->permissionDenied();
        }

        $audits = $this->element->audits()->with(['user', 'auditable'])->get();
        // return $audits;

        if ($this->expectsJson()) {
            return $this->success()->load($audits)->json();
        }

        return $this->view($this->view->changesPath())
            ->with(['audits' => $audits, 'element' => $this->element]);

    }

    /**
     * Get all the comments of an element
     *
     * @param  null  $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function comments($id)
    {
        request()->merge([
            'module_id' => $this->module->id,
            'element_id' => $id,
        ]);

        return app(CommentController::class)->listJson();
    }

    /**
     * Store comment files under an element
     *
     * @param  null  $id
     * @return ModularController
     */
    public function attachComment($id)
    {
        request()->merge([
            'module_id' => $this->module->id,
            'element_id' => $id,
        ]);

        return app(CommentController::class)->store(request());
    }

    /**
     * Check if the call is an API call
     *
     * @return bool
     */
    public function isApiCall()
    {
        return in_array('api', $this->getAllMiddleWares());
    }

    /**
     * Get all middlewares
     *
     * @return array
     */
    public function getAllMiddleWares()
    {
        $routeMiddlewares = request()->route()->middleware();
        $controllerMiddlewares = Arr::pluck($this->getMiddleware(), 'middleware');

        return array_merge($routeMiddlewares, $controllerMiddlewares);
    }

    /**
     * @return array|bool|string
     */
    public function uuid()
    {
        return request()->old('uuid') ?: uuid();
    }

    /**
     * Define which relations to load along with the model
     *
     * @return array|false|string[]
     */
    public function relations()
    {
        return $this->relationsFromRequest();
    }

    /**
     * Model relationship can be defined through URL i.e. ..&with=groups,uploads
     *
     * @return array|false|string[]
     */
    public function relationsFromRequest()
    {
        return request('with') ? explode(',', request('with')) : [];
    }
}
