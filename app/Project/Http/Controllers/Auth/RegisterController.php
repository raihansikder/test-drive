<?php

namespace App\Project\Http\Controllers\Auth;

use View;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Project\Features\Core\ViewProcessor;
use App\Project\Providers\RouteServiceProvider;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Http\Controllers\Auth\RegisterController as MainframeRegisterController;

class RegisterController extends MainframeRegisterController
{
    /** @var string */
    protected $form = 'project.auth.register';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * If not group is specified then user will be registered to this default group;
     *
     * @var string
     */
    protected $defaultGroupName = 'user';

    /** @var array */
    protected $groupsAllowedForRegistration = [
        'user',
    ];

    public function __construct()
    {
        parent::__construct();
        // Share project's view processor
        $this->view = new ViewProcessor();
        View::share([
            'view' => $this->view,
        ]);
    }

    /**
     * Process input for registration.
     *
     * @return $this
     */
    public function attemptRegistration()
    {
        // Validate
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            //'mobile'     => 'required|numeric|unique:users,mobile',
            'password' => User::PASSWORD_VALIDATION_RULE,
        ]);

        if ($validator->fails()) {
            $this->setValidator($validator);

            return $this;
        }

        // Create user
        $this->user = $this->createUser();
        if (!$this->user) {
            $this->fail('User creation failed');

            return $this;
        }

        $this->success('Verify your email and log in.');
        $this->registered(request(), $this->user);

        return $this;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return BaseModule|false
     */
    protected function createUser()
    {
        $user = new User([
            'tenant_id' => request('tenant_id'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'name' => request('first_name').' '.request('last_name'),
            'email' => request('email'),
            'mobile' => request('mobile'),
            'password' => Hash::make(request('password')),
            'group_ids' => [(string) $this->group->id],
            'is_active' => 1,
        ]);

        $processor = $user->processor()->save();

        if ($processor->isInvalid()) {
            return false;
        }

        return $processor->element;
    }

}
