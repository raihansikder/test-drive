<?php

namespace App\Mainframe\Modules\Changes\Traits;

trait ChangePolicyTrait
{
    // /**
    //  * view-any
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function viewAny($user) { return parent::viewAny($user); }

    // /**
    //  * view
    //  *
    //  * @param  \App\User  $user
    //  * @param  Change  $element
    //  * @return mixed
    //  */
    // public function view($user, $element) {if (! parent::view($user, $element)) {return false;} return true;}
    // public function create($user, $element = null) {if (! parent::create($user, $element)) {return false;} return true;}
    public function update($user, $element)
    {
        // if (!parent::update($user, $element)) {
        //     return false;
        // }
        // return true;
        return false; // An entry should not be updated in future
    }
    // public function delete($user, $element) {if (! parent::delete($user, $element)) {return false;} return true;}
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}
}
