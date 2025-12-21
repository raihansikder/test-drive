<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class CommentProcessor extends ModelProcessor
{
    use CommentProcessorTrait;
}
