<?php

namespace App\Mainframe\Modules\Users\Traits;

trait UserObserverTrait
{
    // /**
    //  * @param  \App\User  $element
    //  * @return void|bool
    //  */
    // public function saving($element) { }

    // public function creating($element) { }
    // public function created($element) { }
    // public function updating($element) { }
    // public function updated($element) { }

    /**
     * @param  \App\User  $element
     * @return void
     */
    public function saved($element)
    {
        $element->runCommonExecutablesOnSaved();
        $element->groups()->sync($element->group_ids);
    }
    // public function deleting($element) { }

    /**
     * @param  \App\User  $element
     * @return void
     */
    public function deleted($element)
    {
        $class = $element->module()->rootModelClassPath();

        $element->runCommonExecutablesOnDeleted();

        \DB::table('user_group')->where('user_id', $element->id)->delete();
        \DB::table('notifications')->where('notifiable_type', $class)->where('notifiable_id',
            $element->id)->delete();
        \DB::table('in_app_notifications')->where('notifiable_type', $class)->where('notifiable_id',
            $element->id)->delete();
        \DB::table('push_notifications')->where('user_id', $element->id)->delete();
    }
    // public function restored($element) { }
    // public function forceDeleted($element) { }
}
