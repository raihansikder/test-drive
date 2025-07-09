<?php

namespace App\Mainframe\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Project\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */
    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Default redirect to home '/'

    /** @var string */
    protected $form = 'mainframe.auth.passwords.confirm';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display the password confirmation view.
     *
     * @return Factory|View
     */
    public function showConfirmForm()
    {
        return view($this->form);
    }
}
