<?php

namespace App\Mainframe\Features\Modular\BaseModule;

class BaseModuleObserver
{
    /**
     * @param  BaseModule|mixed  $element
     * @return void
     */
    public function saving($element)
    {
        $element->autoFill(); // This has been moved to processor forSave()
    }


    // public function creating($element) { }
    // public function created($element) { }
    // public function updating($element) { }
    // public function updated($element) { }

    /**
     * @param  BaseModule|mixed  $element
     * @return void
     */
    public function saved($element)
    {
        $element->runCommonExecutablesOnSaved();
    }
    // public function deleting($element) { }
    // public function deleted($element) { }
    // public function restored($element) { }
    // public function forceDeleted($element) { }
}
