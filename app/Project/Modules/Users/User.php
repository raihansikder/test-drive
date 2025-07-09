<?php

namespace App\Project\Modules\Users;

use App\Group;
use App\Project\Scopes\CheckTenantScope;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Project\Modules\Users\User
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $api_token X-Auth-Token
 * @property string|null $api_token_generated_at
 * @property int $is_tenant_editable
 * @property array $permissions
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $name_initial
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $full_name
 * @property string|null $gender
 * @property string|null $device_token
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $county
 * @property int|null $country_id
 * @property string|null $country_name
 * @property string|null $zip_code
 * @property string|null $phone
 * @property string|null $mobile
 * @property \Illuminate\Support\Carbon|null $first_login_at
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $auth_token Bearer token
 * @property string|null $email_verified_at
 * @property string|null $email_verification_code
 * @property string|null $currency
 * @property string|null $social_account_id
 * @property string|null $social_account_type
 * @property string|null $dob
 * @property array|null $group_ids
 * @property int|null $is_test
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\Country|null $country
 * @property-read \App\User|null $creator
 * @property-read null|string $profile_pic
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InAppNotification[] $inAppNotifications
 * @property-read int|null $in_app_notifications_count
 * @property-read \App\Module $linkedModule
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|User active()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress1($value)
 * @method static Builder|User whereAddress2($value)
 * @method static Builder|User whereApiToken($value)
 * @method static Builder|User whereApiTokenGeneratedAt($value)
 * @method static Builder|User whereAuthToken($value)
 * @method static Builder|User whereCity($value)
 * @method static Builder|User whereCountryId($value)
 * @method static Builder|User whereCountryName($value)
 * @method static Builder|User whereCounty($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCreatedBy($value)
 * @method static Builder|User whereCurrency($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereDeletedBy($value)
 * @method static Builder|User whereDeviceToken($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerificationCode($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstLoginAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereFullName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereGroupIds($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsActive($value)
 * @method static Builder|User whereIsTenantEditable($value)
 * @method static Builder|User whereIsTest($value)
 * @method static Builder|User whereLastLoginAt($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User whereMobile($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNameInitial($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePermissions($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereProjectId($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSocialAccountId($value)
 * @method static Builder|User whereSocialAccountType($value)
 * @method static Builder|User whereTenantId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUpdatedBy($value)
 * @method static Builder|User whereUuid($value)
 * @method static Builder|User whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $group
 * @property string|null $date_of_birth
 * @method static Builder|User whereDateOfBirth($value)
 * @property string|null $name_ext
 * @property string|null $slug
 * @method static Builder|User whereNameExt($value)
 * @method static Builder|User whereSlug($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 */
class User extends \App\Mainframe\Modules\Users\User
{
    use UserHelper;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'users';
    protected $table = 'users';

    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'email', 'password', 'remember_token', 'api_token', 'api_token_generated_at', 'is_tenant_editable', 'permissions', 'is_active', 'name_initial', 'first_name', 'last_name', 'full_name', 'gender', 'device_token', 'address1', 'address2', 'city', 'county', 'country_id', 'country_name', 'zip_code', 'phone', 'mobile', 'first_login_at', 'last_login_at', 'auth_token', 'email_verified_at', 'email_verification_code', 'currency', 'social_account_id', 'social_account_type', 'dob', 'group_ids', 'is_test',];
    // protected $hidden = ['password', 'remember_token'];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at', 'first_login_at', 'last_login_at',];
    // protected $casts = ['group_ids' => 'array', 'created_at' => 'datetime', 'updated_at' => 'datetime', 'deleted_at' => 'datetime', 'first_login_at' => 'datetime', 'last_login_at' => 'datetime',];
    // protected $with = []; // NOte - Avoid using this auto append model feature
    // protected $appends = [];
    // protected $spreadFields = ['group_ids' => Group::class,];
    // protected $tagFields = [];

    /*
    |--------------------------------------------------------------------------
    | Code: Tenant configs
    |--------------------------------------------------------------------------
    */

    // protected $tenantEnabled = false;
    // protected $showGlobalTenantElements = true;
    // protected $showNonTenantElements = true;

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */
    /**
     * Password validation rule
     */
    // public const PASSWORD_VALIDATION_RULE = 'required|confirmed|min:6|regex:/[a-zA-Z]/|regex:/[0-9]/';
    /*
    |--------------------------------------------------------------------------
    | User group definitions
    |--------------------------------------------------------------------------
    */
    // Section - Define you project specific groups
    // public const FACILITY_ADMIN_GROUP_ID = 999;
    // public const FACILITY_USER_GROUP_ID  = 999;

    // public const FACILITY_ADMIN_GROUP_NAME = 'facility-admin';
    // public const FACILITY_USER_GROUP_NAME  = 'facility-user';

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();
        self::observe(UserObserver::class);

        // Add Tenant Scope
        if (user()->ofTenant()) {
            static::addGlobalScope(new CheckTenantScope(user()->tenant_id));
        }

        // static::saving(function (User $element) { });
        // static::creating(function (User $element) { });
        // static::updating(function (User $element) { });
        // static::created(function (User $element) { });
        // static::updated(function (User $element) { });
        // static::saved(function (User $element) { });
        // static::deleting(function (User $element) { });
        // static::deleted(function (User $element) { });
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Send email verification link.
     */
    public function sendEmailVerificationNotification()
    {
        return parent::sendEmailVerificationNotification();
    }

    /**
     * Send reset password link
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        return parent::sendPasswordResetNotification($token);
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section:  Accessors
    |--------------------------------------------------------------------------
    */
    // public function getFirstNameAttribute($value) { return ucfirst($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */

}
