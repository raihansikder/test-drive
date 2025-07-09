<?php

namespace App\Mainframe\Modules\Users;

use App\Project\Features\Modular\Validator\ModelProcessor;
use App\Mainframe\Modules\Users\Traits\UserProcessorTrait;

class UserProcessor extends ModelProcessor
{

    use UserProcessorTrait;

    /**
     * @return string[]
     */
    public function immutables()
    {
        // Only allow superusers to change email
        if (!$this->user->isSuperUser()) {
            $this->addImmutables(['email']);
        }

        return $this->immutables;
    }


}
