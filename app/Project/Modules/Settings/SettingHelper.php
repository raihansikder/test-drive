<?php

namespace App\Project\Modules\Settings;

/** @mixin Setting $this */
trait SettingHelper
{
    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */

    // /**
    //  * Populate model
    //  * return $this
    //  */
    // public function populate()
    // {
    //     return $this;
    // }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------|
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return false; }

    public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
