<?php

namespace App\Mainframe\Modules\SupportTickets\Traits;

/** @mixin \App\Mainframe\Modules\SupportTickets\SupportTicketViewProcessor */
trait SupportTicketViewProcessorTrait
{
    /**
     * @var \App\Module
     * @var \Illuminate\Database\Eloquent\Builder
     * @var \App\SupportTicket
     * @var bool
     * @var array
     * @var string i.e. View type create, edit, index etc.
     * @var array Variables shared in view blade
     */

    // Note: See parent class for available functions
    // public function immutables() { $this->mergeImmutables(['your_field']); return $this->immutables; }
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

    /**
     * Show the reviewer section
     *
     * @return bool
     */
    public function showReviewerSection()
    {
        if (! $this->element->isCreated()) {
            return false;
        }

        return $this->user->isAdmin();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Report related view helpers
    |--------------------------------------------------------------------------
    */

}
