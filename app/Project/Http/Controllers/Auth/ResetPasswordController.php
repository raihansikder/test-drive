<?php

namespace App\Project\Http\Controllers\Auth;

use View;
use App\Project\Features\Core\ViewProcessor;
use App\Mainframe\Http\Controllers\Auth\ResetPasswordController as MfResetPasswordController;

class ResetPasswordController extends MfResetPasswordController
{
    /** @var string */
    protected $form = 'project.auth.passwords.reset';

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
