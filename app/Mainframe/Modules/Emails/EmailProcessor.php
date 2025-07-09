<?php

namespace App\Mainframe\Modules\Emails;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Emails\Traits\EmailProcessorTrait;

class EmailProcessor extends ModelProcessor
{
    use EmailProcessorTrait;
}
