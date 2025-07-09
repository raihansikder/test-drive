<?php

namespace App\Mainframe\Modules\Users\Traits;

/** @mixin \App\User */
trait UserPolicyTrait
{
    /**
     * view
     *
     * @param  \App\User  $user
     * @param  \App\User  $element
     * @return bool
     */
    public function view($user, $element)
    {
        if (!parent::view($user, $element)) {
            return false;
        }
        // Todo: Allow access to users based on your project
        if (!$user->isAdmin()) {
            return $user->id == $element->id;
        }

        return true;
    }

    // public function create($user, $element = null) {if (! parent::create($user, $element)) {return false;} return true;}

    /**
     * view
     *
     * @param  \App\User  $user
     * @param  \App\User  $element
     * @return bool
     */
    // public function update($user, $element) {if (!parent::update($user, $element)) {return false;}return true;}
    // public function delete($user, $element) {if (! parent::delete($user, $element)) {return false;} return true;}
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}

    /**
     * Check if user can access Api
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function makeApiCall($user)
    {
        if (!$user->hasPermission('make-api-call')) {
            return false;
        }

        return true;
    }

    /**
     * @param  \App\User  $user
     * @param  \App\User  $element
     * @return bool
     */
    public function updateToken($user, $element)
    {
        if (!$user->isSuperUser() || $user->isA('app-admin')) {
            return true;
        }

        return false;
    }
}
