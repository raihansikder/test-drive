<?php

namespace App\Mainframe\Modules\Groups\Traits;

use Artisan;
use App\Group;

/** @mixin \App\Mainframe\Modules\Groups\GroupProcessor */
trait GroupProcessorTrait
{
    /*
     |--------------------------------------------------------------------------
     | Section - Validation
     |--------------------------------------------------------------------------
     */

    // /**
    //  * @param  Group  $element
    //  * @return $this
    //  */
    // public function fill($element) { return $this; }

    /**
     * Validation rules. For regular expression validation use array instead of pipe
     *
     * @param       $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,255|unique:modules,name,'.(isset($element->id) ? (string) $element->id : 'null').',id,deleted_at,NULL',
            // 'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Section - Processor Events
    |--------------------------------------------------------------------------
    */

    /**
     * @param $element Group
     * @return $this
     */
    public function saving($element)
    {
        if ($this->isValid()) {
            $this->setPermissions($element);
        }
        return $this;
    }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }

    /**
     * @param  \App\Group  $element
     * @return $this
     */
    public function updated($element)
    {
        $this->clearCacheIfPermissionHasChanged();
        return $this;
    }
    // public function saved($element) { return $this; }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */

    /**
     * @return string[]
     */
    public function immutables()
    {
        return ['name'];
    }
    // public function getTransitions(){return $this->transitions; }

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Other helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * @param  \App\Group  $element
     * @return void
     */
    public function setPermissions($element)
    {
        $permissions = [];

        // include new group permissions from form input
        if (request('permission')) {
            // revoke existing group permissions
            $existing_permissions = $element->getPermissions();
            foreach ($existing_permissions as $k => $v) {
                $permissions[$k] = 0;
            }
            foreach (request('permission') as $k) {
                $permissions[$k] = 1;
            }
        }

        $element->permissions = array_merge($element->permissions, $permissions);
    }

    /**
     * @return void
     */
    public function clearCacheIfPermissionHasChanged()
    {
        if ($this->fieldHasChanged('permissions')) {
            $this->addMessage('Permission changed');
            Artisan::call('cache:clear');
        }
    }

}
