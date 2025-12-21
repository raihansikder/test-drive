<?php

namespace App\Mainframe\Modules\Uploads\Traits;

trait UploadViewProcessorTrait
{
    /**
     * @var \App\Module
     * @var \Illuminate\Database\Eloquent\Builder
     * @var \App\Upload
     * @var bool
     * @var array
     * @var string i.e. View type create, edit, index etc.
     * @var array Variables shared in view blade
     */

    // Note: See parent class for available functions
    // public function immutables() { $this->mergeImmutables(['your_field']); return $this->immutables; }
    /**
     * @return array
     */
    public function immutables()
    {
        return array_merge(parent::immutables(), [
            'type',
            'ext',
            'bytes',
        ]);
    }
    // public function hiddenFields() { $this->addHiddenFields(['your_field']); return $this->hiddenFields; }

    /*
    |--------------------------------------------------------------------------
    | Section: Blade template locations
    |--------------------------------------------------------------------------
    */

    // public function formPath($state = 'create') { }
    // public function gridPath() { }
    // public function changesPath() { }

    /*
    |--------------------------------------------------------------------------
    | Section: View Variables
    |--------------------------------------------------------------------------
    */

    // public function varsCreate() { }
    // public function viewVarsEdit() { }
    // public function formTitle() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Condition functions to show a section in view
    |--------------------------------------------------------------------------
    */
    // public function showFormCreateBtn() { }
    // public function showFormListBtn() { }
    // public function showReportLink() { }
    // public function showTenantSelector() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Report related view helpers
    |--------------------------------------------------------------------------
    */
}
