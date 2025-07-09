<?php

namespace App\Mainframe\Modules\PushNotifications\Traits;

use App\Module;

/** @mixin \App\Mainframe\Modules\PushNotifications\PushNotificationController */
trait PushNotificationControllerTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    */
    // public function datatable() { }
    // public function listJson() { }
    // public function report() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */
    // public function storeRequestValidator() { }
    // public function updateRequestValidator() { }
    // public function saveRequestValidator() { }
    // public function attemptStore() { }
    // public function attemptUpdate() { }
    // public function attemptDestroy() { }
    // public function stored() { }
    // public function updated() { }
    // public function saved() { }
    // public function deleted() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Custom Controller functions
    |--------------------------------------------------------------------------
    */
    /**
     * Fill module_id from module='module-name' URL param
     *
     * @return $this
     */
    public function fill()
    {
        // Resolve module from name
        if ($val = request('module')) {
            $this->element->module_id = optional(Module::byName($val))->id;
        }

        return parent::fill();
    }
}
