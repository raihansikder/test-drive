<?php

namespace App\Mainframe\Modules\Uploads\Traits;

trait UploadObserverTrait
{
    /**
     * @param  \App\Upload|mixed  $element
     * @return void|bool
     */
    public function saving($element)
    {
        parent::saving($element);
        $element->fillModuleAndElement('uploadable');
        $element->fillFileInfo();
    }

    /**
     * @param  \App\Upload  $element
     * @return void|bool
     */
    // public function creating($element) { }
    // public function created($element) { }
    // public function updating($element) { }
    // public function updated($element) { }

    /**
     * @param  \App\Upload|mixed  $element
     * @return void|bool
     */
    public function saved($element)
    {
        $element->refresh(); // Essential for establishing following relation
        if ($element->isSingleUpload()) {
            $element->deletePreviousOfSameType();
        }
    }
    // public function deleting($element) { }
    // public function deleted($element) { }
    // public function restored($element) { }
    // public function forceDeleted($element) { }
}
