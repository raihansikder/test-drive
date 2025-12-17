<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentObserverTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleObserver;

class CommentObserver extends BaseModuleObserver
{
    use CommentObserverTrait;
}
