<?php /** @noinspection ALL */

namespace App\Project\Http\Controllers\Auth;

use App\Project\Features\Core\ViewProcessor;
use App\Mainframe\Http\Controllers\Auth\RegisterTenantController as MfRegisterTenantController;

class RegisterTenantController extends MfRegisterTenantController
{
    public function __construct()
    {
        parent::__construct();
        // Share project's view processor
        $this->view = new ViewProcessor();
        \View::share([
            'view' => $this->view,
        ]);
    }

}
