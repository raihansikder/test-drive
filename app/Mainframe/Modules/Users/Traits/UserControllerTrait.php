<?php

namespace App\Mainframe\Modules\Users\Traits;

use Hash;
use App\User;
use Validator;
use App\Project\Modules\Users\UserList;
use App\Project\Modules\Users\UserDatatable;
use App\Mainframe\Modules\Users\UserResource;
use App\Mainframe\Modules\Users\UserCollection;

trait UserControllerTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    */

    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        if (!$this->user->can('view-any', $this->model)) {
            return $this->permissionDenied();
        }

        # Respond as JSON/API
        if ($this->expectsJson()) {
            // Note - Example with custom UserCollection
            return (new UserList($this->module))->json(UserCollection::class);
        }

        # Show default module grid
        $this->view->setType('index')->setDatatable($this->datatable());

        return $this->view($this->view->gridPath());
    }

    /**
     * Show
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @urlParam  id required The ID of the item.
     */
    public function show($id)
    {
        if (!$this->element = $this->model->with($this->relations())->find($id)) {
            return $this->notFound();
        }

        if (!$this->user->can('view', $this->element)) {
            return $this->permissionDenied();
        }

        # Redirect to edit page.
        // Note - Example with custom UserResource
        return $this->load(new UserResource($this->element))
            ->to(route($this->moduleName.'.edit', $id))
            ->send();

    }

    /**
     * Datatable
     *
     * @return UserDatatable
     */
    public function datatable()
    {
        return new UserDatatable($this->module);
    }

    // public function report() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Prepare the model, First transform the input and then fill
     *
     * @return \App\Mainframe\Modules\Users\Traits\UserControllerTrait
     */
    public function fill()
    {
        $inputs = request()->except('password');

        // Hash password
        if (request('password')) {
            $inputs['password'] = Hash::make(request('password'));
        }

        $this->element->fill($inputs);

        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function storeRequestValidator()
    {
        return Validator::make(request()->all(),
            ['password' => User::PASSWORD_VALIDATION_RULE,],
            ['password.regex' => 'The password field should be mix of letters and numbers.',]
        );

    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function updateRequestValidator()
    {
        if (request('password')) {
            return $this->storeRequestValidator();
        }

        return $this->validator();
    }



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
    */

    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function profile()
    {
        return app(self::class)->edit($this->user->id);
    }
}
