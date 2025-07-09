<?php

namespace App\Project\Http\Controllers;

use View;
use App\Project\Features\Core\ViewProcessor;
use App\Mainframe\Http\Controllers\BaseController as MainframeBaseController;

class BaseController extends MainframeBaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->user = user();
        $this->view = new ViewProcessor();

        View::share([
            'user' => $this->user,
            'view' => $this->view,
        ]);
    }
}
