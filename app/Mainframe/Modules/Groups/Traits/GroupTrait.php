<?php

namespace App\Mainframe\Modules\Groups\Traits;

use DB;
use Artisan;
use App\User;
use App\Group;
use InvalidArgumentException;

trait GroupTrait
{

    protected $allowedPermissionsValues = [0, 1];

    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */
    /**
     * Accessor for giving permissions.
     *
     * @param  mixed  $permissions
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getPermissionsAttribute($permissions)
    {
        if (!$permissions) {
            return [];
        }

        if (is_array($permissions)) {
            return $permissions;
        }

        if (!$_permissions = json_decode($permissions, true)) {
            throw new InvalidArgumentException("Cannot JSON decode permissions [$permissions].");
        }

        return $_permissions;
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */
    /**
     * Mutator for taking permissions.
     *
     * @param  array  $permissions
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setPermissionsAttribute(array $permissions)
    {
        // Merge permissions
        $permissions = array_merge($this->getPermissions(), $permissions);

        // Loop through and adjust permissions as needed
        foreach ($permissions as $permission => &$value) {
            // Lets make sure their is a valid permission value
            if (!in_array($value = (int) $value, $this->allowedPermissionsValues)) {
                throw new InvalidArgumentException("Invalid value [$value] for permission [$permission] given.");
            }

            // If the value is 0, delete it
            if ($value === 0) {
                unset($permissions[$permission]);
            }
        }

        $this->attributes['permissions'] = (!empty($permissions)) ? json_encode($permissions) : '';
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

    public function users() { return $this->belongsToMany(User::class, 'user_group'); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Autofill functions 
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */
    /**
     * Get Permissions
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * See if a group has access to the passed permission(s).
     * If multiple permissions are passed, the group must
     * have access to all permissions passed through, unless the
     * "all" flag is set to false.
     *
     * @param  string|array  $permissions
     * @param  bool  $all
     * @return bool
     */
    public function hasAccess($permissions, $all = true)
    {
        $groupPermissions = $this->getPermissions();

        foreach ((array) $permissions as $permission) {
            // We will set a flag now for whether this permission was
            // matched at all.
            $matched = true;

            // Now, let's check if the permission ends in a wildcard "*" symbol.
            // If it does, we'll check through all the merged permissions to see
            // if a permission exists which matches the wildcard.
            if ((strlen($permission) > 1) and ends_with($permission, '*')) {
                $matched = false;

                foreach ($groupPermissions as $groupPermission => $value) {
                    // Strip the '*' off the end of the permission.
                    $checkPermission = substr($permission, 0, -1);

                    // We will make sure that the merged permission does not
                    // exactly match our permission, but starts with it.
                    if ($checkPermission != $groupPermission and starts_with($groupPermission,
                            $checkPermission) and $value == 1) {
                        $matched = true;
                        break;
                    }
                }
            }

            // Now, let's check if the permission starts in a wildcard "*" symbol.
            // If it does, we'll check through all the merged permissions to see
            // if a permission exists which matches the wildcard.
            else {
                if ((strlen($permission) > 1) and starts_with($permission, '*')) {
                    $matched = false;

                    foreach ($groupPermissions as $groupPermission => $value) {
                        // Strip the '*' off the start of the permission.
                        $checkPermission = substr($permission, 1);

                        // We will make sure that the merged permission does not
                        // exactly match our permission, but ends with it.
                        if ($checkPermission != $groupPermission and ends_with($groupPermission,
                                $checkPermission) and $value == 1) {
                            $matched = true;
                            break;
                        }
                    }
                } else {
                    $matched = false;

                    foreach ($groupPermissions as $groupPermission => $value) {
                        // This time check if the groupPermission ends in wildcard "*" symbol.
                        if ((strlen($groupPermission) > 1) and ends_with($groupPermission, '*')) {
                            $matched = false;

                            // Strip the '*' off the end of the permission.
                            $checkGroupPermission = substr($groupPermission, 0, -1);

                            // We will make sure that the merged permission does not
                            // exactly match our permission, but starts wtih it.
                            if ($checkGroupPermission != $permission and starts_with($permission,
                                    $checkGroupPermission) and $value == 1) {
                                $matched = true;
                                break;
                            }
                        }

                        // Otherwise, we'll fallback to standard permissions checking where
                        // we match that permissions explicitly exist.
                        else {
                            if ($permission == $groupPermission and $groupPermissions[$permission] == 1) {
                                $matched = true;
                                break;
                            }
                        }
                    }
                }
            }

            // Now, we will check if we have to match all
            // permissions or any permission and return
            // accordingly.
            if ($all === true and $matched === false) {
                return false;
            }

            if ($all === false and $matched === true) {
                return true;
            }
        }

        return $all;

    }

    /**
     * Returns if the user has access to any of the
     * given permissions.
     *
     * @param  array  $permissions
     * @return bool
     */
    public function hasAnyAccess(array $permissions)
    {
        return $this->hasAccess($permissions, false);
    }

    /**
     * Load config permission to database
     *
     * @param $config
     * @return false
     */
    public function refreshPermissionFromConfig($config = null)
    {
        Artisan::call('config:clear');
        $config = $config ?: projectKey().'.permissions.'.$this->name;

        $permission = config($config);

        if (!$permission) {
            $this->error('No config found at '.$config);
            return false;
        }

        DB::table('groups')->where('id', $this->id)->update([
            'permissions' => json_encode($permission),
        ]);

        Artisan::call('cache:clear');

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */

    /**
     * Get group by name
     *
     * @param $name
     * @return \App\Group
     */
    public static function byName($name)
    {
        return Group::where('name', $name)->remember(timer('very-long'))->first();
    }

    /**
     * Get superadmin group
     *
     * @return mixed|\App\Group
     */
    public static function superadmin()
    {
        return Group::where('name', 'superuser')
            ->remember(timer('very-long'))
            ->first();
    }

    /**
     * Get superadmin group
     *
     * @return mixed|Group
     */
    public static function api()
    {
        return Group::where('name', 'api')
            ->remember(timer('very-long'))
            ->first();
    }

    /**
     * Get superadmin group
     *
     * @return mixed|Group
     */
    public static function projectAdmin()
    {
        return Group::where('name', 'project-admin')
            ->remember(timer('very-long'))
            ->first();
    }

    /**
     * Get superadmin group
     *
     * @return mixed|Group
     */
    public static function tenantAdmin()
    {
        return Group::where('name', User::TENANT_ADMIN_GROUP)
            ->remember(timer('very-long'))
            ->first();
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }
    // public function isCloneable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    */

}
