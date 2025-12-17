<?php

namespace App\Mainframe\Modules\Contents\Traits;

/** @mixin \App\Mainframe\Modules\Contents\ContentViewProcessor */
trait ContentViewProcessorTrait
{
    /**
     * @var \App\Module
     * @var \Illuminate\Database\Eloquent\Builder
     * @var \App\Content
     * @var bool
     * @var array
     * @var string i.e. View type create, edit, index etc.
     * @var array Variables shared in view blade
     */

    /**
     * @return array
     */
    public function immutables()
    {
        if (! $this->user->isSuperUser()) {
            $this->addImmutables(['name', 'key', 'is_active']);
        }

        return $this->immutables;
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
