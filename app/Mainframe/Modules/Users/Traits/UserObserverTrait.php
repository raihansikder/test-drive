<?php

namespace App\Mainframe\Modules\Users\Traits;

trait UserObserverTrait
{
    /**
     * @param  \App\User  $element
     * @return void|bool
     */
    // public function saving($element) { }
    // public function creating($element) { }
    // public function created($element) { }
    // public function updating($element) { }
    // public function updated($element) { }

    /**
     * @param  \App\User  $element
     * @return void|bool
     */
    public function saved($element)
    {
        $element->runCommonExecutablesOnSaved();
        $element->groups()->sync($element->group_ids);
    }
    // public function deleting($element) { }
    // public function deleted($element) { }
    // public function restored($element) { }
    // public function forceDeleted($element) { }
}
