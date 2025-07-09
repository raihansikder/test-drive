<?php

namespace App\Mainframe\Modules\Assignments\Traits;

/** @mixin \App\Mainframe\Modules\Assignments\AssignmentObserver */
trait AssignmentObserverTrait
{
    /**
     * @param  \App\Assignment  $element
     * @return void
     */
    public function saving($element)
    {
        parent::saving($element);
        $element->fillModuleAndElement('assignable');
    }

    // public function creating($element) { }
    // public function created($element) { }
    // public function updating($element) { }
    // public function updated($element) { }
    // public function saved($element) { }
    // public function deleting($element) { }
    // public function deleted($element) { }
    // public function restored($element) { }
    // public function forceDeleted($element) { }
}
