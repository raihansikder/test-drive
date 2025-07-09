<?php

namespace App\Mainframe\Modules\Users;

use App\Group;
use Watson\Rememberable\Rememberable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mainframe\Features\Core\Traits\Validable;
use App\Mainframe\Modules\Users\Traits\UserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mainframe\Features\Modular\BaseModule\Traits\ModularTrait;

class User extends Authenticatable implements MustVerifyEmail, Auditable
{
    use SoftDeletes,
        Rememberable,
        \OwenIt\Auditing\Auditable,
        ModularTrait,
        Validable,
        Notifiable,
        UserTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'email',
        'password',
        'remember_token',
        'api_token',
        'api_token_generated_at',
        'is_tenant_editable',
        'permissions',
        'is_active',
        'name_initial',
        'first_name',
        'last_name',
        'full_name',
        'gender',
        'device_token',
        'address1',
        'address2',
        'city',
        'county',
        'country_id',
        'country_name',
        'zip_code',
        'phone',
        'mobile',
        'first_login_at',
        'last_login_at',
        'auth_token',
        'email_verified_at',
        'email_verification_code',
        'currency',
        'social_account_id',
        'social_account_type',
        'dob',
        'group_ids',
        'is_test',
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'first_login_at', 'last_login_at', 'email_verified_at',
    ];
    protected $casts = [
        'group_ids' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'first_login_at' => 'datetime',
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    // protected $with = [];
    protected $appends = [];
    protected $spreadFields = ['group_ids' => Group::class,];
    protected $tagFields = [];

    /*
    |--------------------------------------------------------------------------
    | Code: Tenant configs
    |--------------------------------------------------------------------------
    */
    /**
     * Enable tenant context
     *
     * @var bool
     */
    protected $tenantEnabled = false;
    /**
     * If true then tenants will be able to see items where tenant_id=0
     *
     * @var bool
     */
    protected $showGlobalTenantElements = true;
    /**
     * If true then tenants will be able to see items where tenant_id=null
     *
     * @var bool
     */
    protected $showNonTenantElements = true;

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */
    /**
     * Password validation rule
     */
    public const PASSWORD_VALIDATION_RULE = 'required|confirmed|min:6|regex:/[a-zA-Z]/|regex:/[0-9]/';
    /*
    |--------------------------------------------------------------------------
    | User group definitions
    |--------------------------------------------------------------------------
    */
    public const SUPERUSER_GROUP_ID = 1;
    public const API_GROUP_ID = 2;
    public const TENANT_ADMIN_GROUP_ID = 3;
    public const PROJECT_ADMIN_GROUP_ID = 4;
    public const USER_GROUP_ID = 5;

    public const SUPERUSER_GROUP = 'superuser';
    public const API_GROUP = 'api';
    public const TENANT_ADMIN_GROUP = 'tenant-admin';
    public const PROJECT_ADMIN_GROUP = 'project-admin';
    public const USER_GROUP = 'user';

    public const GENDER_MALE = 'Male';
    public const GENDER_FEMALE = 'Female';

    /**
     * Allowed permissions values.
     * Possible options:
     *   -1 => Deny (adds to array, but denies regardless of user's group).
     *    0 => Remove.
     *    1 => Add.
     *
     * @var array
     */
    protected $allowedPermissionsValues = [-1, 0, 1];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class

}
