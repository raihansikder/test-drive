<?php

namespace App\Project\Modules\Districts;

use App\Upazila;
use App\Division;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Districts\District
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $name_bn
 * @property string|null $code
 * @property string|null $combined_code
 * @property int|null $division_id
 * @property string|null $division_code
 * @property string|null $division_name
 * @property float|null $longitude
 * @property float|null $latitude
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\User|null $creator
 * @property-read Division|null $division
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|BaseModule active()
 * @method static Builder|District newModelQuery()
 * @method static Builder|District newQuery()
 * @method static Builder|District query()
 * @method static Builder|District whereCode($value)
 * @method static Builder|District whereCombinedCode($value)
 * @method static Builder|District whereCreatedAt($value)
 * @method static Builder|District whereCreatedBy($value)
 * @method static Builder|District whereDeletedAt($value)
 * @method static Builder|District whereDeletedBy($value)
 * @method static Builder|District whereDivisionCode($value)
 * @method static Builder|District whereDivisionId($value)
 * @method static Builder|District whereDivisionName($value)
 * @method static Builder|District whereId($value)
 * @method static Builder|District whereIsActive($value)
 * @method static Builder|District whereLatitude($value)
 * @method static Builder|District whereLongitude($value)
 * @method static Builder|District whereName($value)
 * @method static Builder|District whereNameBn($value)
 * @method static Builder|District whereNameExt($value)
 * @method static Builder|District whereProjectId($value)
 * @method static Builder|District whereSlug($value)
 * @method static Builder|District whereTenantId($value)
 * @method static Builder|District whereUpdatedAt($value)
 * @method static Builder|District whereUpdatedBy($value)
 * @method static Builder|District whereUuid($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|Upazila[] $upazilas
 * @property-read int|null $upazilas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class District extends BaseModule
{
    use DistrictHelper;

    protected $moduleName = 'districts';
    protected $table = 'districts';
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
        'name_bn',
        'code',
        'combined_code',
        'division_id',
        'division_code',
        'division_name',
        'longitude',
        'latitude',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

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
        self::observe(DistrictObserver::class);

        // static::saving(function (District $element) { });
        // static::creating(function (District $element) { });
        // static::updating(function (District $element) { });
        // static::created(function (District $element) { });
        // static::updated(function (District $element) { });
        // static::saved(function (District $element) { });
        // static::deleting(function (District $element) { });
        // static::deleted(function (District $element) { });
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

    public function division() { return $this->belongsTo(Division::class); }

    public function upazilas(): HasMany { return $this->hasMany(Upazila::class); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return DistrictProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
