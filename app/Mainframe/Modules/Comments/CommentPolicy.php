<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentPolicyTrait;
use App\Project\Features\Modular\BaseModule\BaseModulePolicy;

class CommentPolicy extends BaseModulePolicy
{
    use CommentPolicyTrait;
}
