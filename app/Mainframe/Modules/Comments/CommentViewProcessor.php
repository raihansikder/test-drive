<?php

namespace App\Mainframe\Modules\Comments;

use App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\Mainframe\Modules\Comments\Traits\CommentViewProcessorTrait;

class CommentViewProcessor extends BaseModuleViewProcessor
{
    use CommentViewProcessorTrait;
}
