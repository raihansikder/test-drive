<?php

namespace App\Mainframe\Http\Controllers\Auth;

use App\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use App\Project\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Default redirect home '/'

    /** @var string */
    protected $form = 'mainframe.auth.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    /*
     * Mainframe overrides
     */
    /**
     * Show the application's login form.
     *
     * @return Factory|View
     */
    public function showLoginForm()
    {
        return view($this->form);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        # Only authenticate a user with is_active=1
        return $this->guard()->attempt(
            array_merge($this->credentials($request), ['is_active' => 1]) // Check is_active
            , $request->filled('remember')
        );
    }


    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  User|mixed  $user
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function authenticated(Request $request, $user)
    {
        $user->hasLoggedIn();

        if ($this->expectsJson()) {
            return $this->success()
                ->load($user->append(['type'])->refresh())
                ->json();
        }
    }

    /**
     * The user has logged out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function loggedOut(Request $request)
    {
        if ($this->expectsJson()) {
            return $this->success('Logged out')->json();
        }
    }
}
