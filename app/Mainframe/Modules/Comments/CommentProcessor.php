<?php

namespace App\Mainframe\Modules\Comments;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Comments\Traits\CommentProcessorTrait;

class CommentProcessor extends ModelProcessor
{
    use CommentProcessorTrait;
}
