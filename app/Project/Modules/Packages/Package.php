<?php

namespace App\Project\Modules\Packages;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Packages\Package
 *
 * @property int $id
 * @property string|null $uuid
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $details
 * @property string|null $monthly_price
 * @property string|null $yearly_price
 * @property string|null $modules
 * @property string|null $limits
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Package newModelQuery()
 * @method static Builder|Package newQuery()
 * @method static Builder|Package query()
 * @method static Builder|Package whereCreatedAt($value)
 * @method static Builder|Package whereCreatedBy($value)
 * @method static Builder|Package whereDeletedAt($value)
 * @method static Builder|Package whereDeletedBy($value)
 * @method static Builder|Package whereDetails($value)
 * @method static Builder|Package whereId($value)
 * @method static Builder|Package whereIsActive($value)
 * @method static Builder|Package whereLimits($value)
 * @method static Builder|Package whereModules($value)
 * @method static Builder|Package whereMonthlyPrice($value)
 * @method static Builder|Package whereName($value)
 * @method static Builder|Package whereNameExt($value)
 * @method static Builder|Package whereSlug($value)
 * @method static Builder|Package whereUpdatedAt($value)
 * @method static Builder|Package whereUpdatedBy($value)
 * @method static Builder|Package whereUuid($value)
 * @method static Builder|Package whereYearlyPrice($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Package extends \App\Mainframe\Modules\Packages\Package
{
    use PackageHelper;

    protected $moduleName = 'packages';
    protected $table = 'packages';
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
        self::observe(PackageObserver::class);

        // static::saving(function (Package $element) { });
        // static::creating(function (Package $element) { });
        // static::updating(function (Package $element) { });
        // static::created(function (Package $element) { });
        // static::updated(function (Package $element) { });
        // static::saved(function (Package $element) { });
        // static::deleting(function (Package $element) { });
        // static::deleted(function (Package $element) { });
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
     * @return PackageProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
