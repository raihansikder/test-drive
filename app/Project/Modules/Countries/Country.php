<?php

namespace App\Project\Modules\Countries;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Countries\Country
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $code
 * @property string|null $country_id
 * @property string|null $iso2
 * @property string|null $country_short_name
 * @property string|null $country_long_name
 * @property string|null $iso3
 * @property string|null $numcode
 * @property string|null $un_member
 * @property string|null $calling_code
 * @property string|null $cctld
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $currency
 * @property string|null $currency_symbol
 * @property string|null $currency_override
 * @property string|null $currency_override_symbol
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country whereCallingCode($value)
 * @method static Builder|Country whereCctld($value)
 * @method static Builder|Country whereCode($value)
 * @method static Builder|Country whereCountryId($value)
 * @method static Builder|Country whereCountryLongName($value)
 * @method static Builder|Country whereCountryShortName($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereCreatedBy($value)
 * @method static Builder|Country whereCurrency($value)
 * @method static Builder|Country whereCurrencyOverride($value)
 * @method static Builder|Country whereCurrencyOverrideSymbol($value)
 * @method static Builder|Country whereCurrencySymbol($value)
 * @method static Builder|Country whereDeletedAt($value)
 * @method static Builder|Country whereDeletedBy($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereIsActive($value)
 * @method static Builder|Country whereIso2($value)
 * @method static Builder|Country whereIso3($value)
 * @method static Builder|Country whereName($value)
 * @method static Builder|Country whereNameExt($value)
 * @method static Builder|Country whereNumcode($value)
 * @method static Builder|Country whereProjectId($value)
 * @method static Builder|Country whereSlug($value)
 * @method static Builder|Country whereTenantId($value)
 * @method static Builder|Country whereUnMember($value)
 * @method static Builder|Country whereUpdatedAt($value)
 * @method static Builder|Country whereUpdatedBy($value)
 * @method static Builder|Country whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Country extends \App\Mainframe\Modules\Countries\Country
{
    use CountryHelper;

    protected $moduleName = 'countries';
    protected $table = 'countries';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(CountryObserver::class);

        // static::saving(function (Country $element) { });
        // static::creating(function (Country $element) { });
        // static::updating(function (Country $element) { });
        // static::created(function (Country $element) { });
        // static::updated(function (Country $element) { });
        // static::saved(function (Country $element) { });
        // static::deleting(function (Country $element) { });
        // static::deleted(function (Country $element) { });
    }

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
    /**
     * Alias method to get the processor
     *
     * @return CountryProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
