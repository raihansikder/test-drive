<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentViewProcessorTrait;
use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;

class CommentViewProcessor extends BaseModuleViewProcessor
{
    use CommentViewProcessorTrait;
}
