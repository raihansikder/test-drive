<?php

namespace App\Project\Modules\Upazilas;

use App\District;
use App\Division;
use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Upazilas\Upazila
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property int|null $tenant_sl
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $name_bn
 * @property string|null $code
 * @property string|null $combined_code
 * @property int|null $division_id
 * @property string|null $division_code
 * @property string|null $division_name
 * @property int|null $district_id
 * @property string|null $district_code
 * @property string|null $district_name
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
 * @property-read District|null $district
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
 * @method static Builder|Upazila newModelQuery()
 * @method static Builder|Upazila newQuery()
 * @method static Builder|Upazila query()
 * @method static Builder|Upazila whereCode($value)
 * @method static Builder|Upazila whereCombinedCode($value)
 * @method static Builder|Upazila whereCreatedAt($value)
 * @method static Builder|Upazila whereCreatedBy($value)
 * @method static Builder|Upazila whereDeletedAt($value)
 * @method static Builder|Upazila whereDeletedBy($value)
 * @method static Builder|Upazila whereDistrictCode($value)
 * @method static Builder|Upazila whereDistrictId($value)
 * @method static Builder|Upazila whereDistrictName($value)
 * @method static Builder|Upazila whereDivisionCode($value)
 * @method static Builder|Upazila whereDivisionId($value)
 * @method static Builder|Upazila whereDivisionName($value)
 * @method static Builder|Upazila whereId($value)
 * @method static Builder|Upazila whereIsActive($value)
 * @method static Builder|Upazila whereLatitude($value)
 * @method static Builder|Upazila whereLongitude($value)
 * @method static Builder|Upazila whereName($value)
 * @method static Builder|Upazila whereNameBn($value)
 * @method static Builder|Upazila whereNameExt($value)
 * @method static Builder|Upazila whereProjectId($value)
 * @method static Builder|Upazila whereSlug($value)
 * @method static Builder|Upazila whereTenantId($value)
 * @method static Builder|Upazila whereTenantSl($value)
 * @method static Builder|Upazila whereUpdatedAt($value)
 * @method static Builder|Upazila whereUpdatedBy($value)
 * @method static Builder|Upazila whereUuid($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Upazila extends BaseModule
{
    use UpazilaHelper;

    protected $moduleName = 'upazilas';
    protected $table = 'upazilas';
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
        'code',
        'name_bn',
        'combined_code',
        'division_id',
        // 'division_code',
        // 'division_name',
        'district_id',
        // 'district_code',
        // 'district_name',
        'latitude',
        'longitude',
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
        self::observe(UpazilaObserver::class);

        // static::saving(function (Upazila $element) { });
        // static::creating(function (Upazila $element) { });
        // static::updating(function (Upazila $element) { });
        // static::created(function (Upazila $element) { });
        // static::updated(function (Upazila $element) { });
        // static::saved(function (Upazila $element) { });
        // static::deleting(function (Upazila $element) { });
        // static::deleted(function (Upazila $element) { });
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

    public function district() { return $this->belongsTo(District::class); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return UpazilaProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
