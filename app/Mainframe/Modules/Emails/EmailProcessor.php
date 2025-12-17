<?php

namespace App\Mainframe\Modules\Emails;

use App\Mainframe\Modules\Emails\Traits\EmailProcessorTrait;
use App\Project\Features\Modular\Validator\ModelProcessor;

class EmailProcessor extends ModelProcessor
{
    use EmailProcessorTrait;
}
