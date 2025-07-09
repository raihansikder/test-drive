<?php

namespace App\Project\Http\Controllers\Auth;

use View;
use App\Project\Features\Core\ViewProcessor;
use App\Project\Providers\RouteServiceProvider;
use App\Mainframe\Http\Controllers\Auth\ConfirmPasswordController as MfConfirmPasswordController;

class ConfirmPasswordController extends MfConfirmPasswordController
{
    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        parent::__construct();
        // Share project's view processor
        $this->view = new ViewProcessor();
        View::share([
            'view' => $this->view,
        ]);
    }

}
