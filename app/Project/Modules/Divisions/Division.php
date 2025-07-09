<?php

namespace App\Project\Modules\Divisions;

use App\Upazila;
use App\District;
use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Divisions\Division
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
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|BaseModule active()
 * @method static Builder|Division newModelQuery()
 * @method static Builder|Division newQuery()
 * @method static Builder|Division query()
 * @method static Builder|Division whereCode($value)
 * @method static Builder|Division whereCombinedCode($value)
 * @method static Builder|Division whereCreatedAt($value)
 * @method static Builder|Division whereCreatedBy($value)
 * @method static Builder|Division whereDeletedAt($value)
 * @method static Builder|Division whereDeletedBy($value)
 * @method static Builder|Division whereId($value)
 * @method static Builder|Division whereIsActive($value)
 * @method static Builder|Division whereLatitude($value)
 * @method static Builder|Division whereLongitude($value)
 * @method static Builder|Division whereName($value)
 * @method static Builder|Division whereNameBn($value)
 * @method static Builder|Division whereNameExt($value)
 * @method static Builder|Division whereProjectId($value)
 * @method static Builder|Division whereSlug($value)
 * @method static Builder|Division whereTenantId($value)
 * @method static Builder|Division whereUpdatedAt($value)
 * @method static Builder|Division whereUpdatedBy($value)
 * @method static Builder|Division whereUuid($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|District[] $districts
 * @property-read int|null $districts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Upazila[] $upazilas
 * @property-read int|null $upazilas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Division extends BaseModule
{
    use DivisionHelper;

    protected $moduleName = 'divisions';
    protected $table = 'divisions';
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
        self::observe(DivisionObserver::class);

        // static::saving(function (Division $element) { });
        // static::creating(function (Division $element) { });
        // static::updating(function (Division $element) { });
        // static::created(function (Division $element) { });
        // static::updated(function (Division $element) { });
        // static::saved(function (Division $element) { });
        // static::deleting(function (Division $element) { });
        // static::deleted(function (Division $element) { });
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

    public function districts() { return $this->hasMany(District::class); }

    public function upazilas() { return $this->hasMany(Upazila::class); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return DivisionProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
