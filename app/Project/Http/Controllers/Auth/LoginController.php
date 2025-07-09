<?php

namespace App\Project\Http\Controllers\Auth;

use View;
use App\User;
use App\SystemEvent;
use Illuminate\Http\Request;
use App\Project\Features\Core\ViewProcessor;
use App\Project\Providers\RouteServiceProvider;
use App\Mainframe\Http\Controllers\Auth\LoginController as MfLoginController;

class LoginController extends MfLoginController
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /** @var string */
    protected $form = 'project.auth.login';

    public function __construct()
    {
        parent::__construct();

        $this->view = new ViewProcessor();
        View::share(['view' => $this->view,]);
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  User|mixed  $user
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Exception
     */
    protected function authenticated(Request $request, $user)
    {
        $user->hasLoggedIn();

        SystemEvent::log(
            'UserAuthenticated',
            ['type' => 'Log', 'url' => route('login'), 'details' => $user, 'user_id' => $user->id],
            $user
        );

        if ($this->expectsJson()) {
            return $this->success()
                ->load($user->append(['type'])->refresh())
                ->json();
        }
    }




}
