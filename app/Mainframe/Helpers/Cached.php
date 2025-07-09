<?php

namespace App\Mainframe\Helpers;

use App\Mainframe\Features\Cacher\Cacher;

class Cached extends Cacher
{
    /*-----------------------------------------------------
    | Section: Function for getting cached results
    |----------------------------------------------------*/
    /**
     * cache.users.[id].group.title
     *
     * @param  null  $seconds
     * @return mixed
     * @throws \Exception
     */
    public function loggedUserGroupName($seconds = null)
    {
        $seconds = $seconds ?? timer('long');

        // $key = $this->key(__FUNCTION__).user()->id; // Create unique key for user
        $key = "cache.users.[".user()->id."].group.title";

        return \Cache::remember($key, $seconds, function () {
            if (user()->group) {
                return ucfirst(user()->group->title);
            }
            return null;
        });
    }

}
