<?php

namespace App\Mainframe\Modules\Settings\Traits;

use App\Mainframe\Modules\Settings\SettingViewProcessor;

/** @mixin SettingViewProcessor */
trait SettingViewProcessorTrait
{
    /**
     * @var \App\Module $module
     * @var \Illuminate\Database\Eloquent\Builder $model
     * @var \App\Setting $element
     * @var bool $editable
     * @var array $immutables
     * @var string $type i.e. View type create, edit, index etc.
     * @var array $vars Variables shared in view blade
     */

    // Note: See parent class for available functions

    /**
     * @return array
     */
    public function immutables()
    {
        if ($this->user->isSuperUser()) {
            return $this->immutables;

        }

        $this->addImmutables([
            'tenant_id',
            'uuid',
            'name',
            'title',
            'type',
            'description',
            // 'value',
            'tenant_editable',
            'is_active',
        ]);

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
