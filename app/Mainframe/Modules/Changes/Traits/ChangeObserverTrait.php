<?php

namespace App\Mainframe\Modules\Changes\Traits;

/** @mixin \App\Mainframe\Modules\Changes\ChangeObserver $this */
trait ChangeObserverTrait
{
    /**
     * @param  \App\Upload|mixed  $element
     * @return void|bool
     */
    public function saving($element)
    {
        parent::saving($element);
        $element->fillModuleAndElement('changeable');
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
