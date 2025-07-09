<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentControllerTrait;
use App\Project\Features\Modular\ModularController\ModularController;

class CommentController extends ModularController
{
    use CommentControllerTrait;
}
