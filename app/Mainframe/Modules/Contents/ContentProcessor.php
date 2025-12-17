<?php

namespace App\Mainframe\Modules\Contents;

use App\Mainframe\Modules\Contents\Traits\ContentProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class ContentProcessor extends ModelProcessor
{
    use ContentProcessorTrait;
}
