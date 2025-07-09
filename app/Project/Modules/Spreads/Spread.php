<?php

namespace App\Project\Modules\Spreads;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Spreads\Spread
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $spreadable_type
 * @property int|null $spreadable_id
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property string|null $key Field name
 * @property string|null $tag Tag name
 * @property string|null $relates_to The second model
 * @property int|null $related_id
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
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $spreadable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Spread newModelQuery()
 * @method static Builder|Spread newQuery()
 * @method static Builder|Spread query()
 * @method static Builder|Spread whereCreatedAt($value)
 * @method static Builder|Spread whereCreatedBy($value)
 * @method static Builder|Spread whereDeletedAt($value)
 * @method static Builder|Spread whereDeletedBy($value)
 * @method static Builder|Spread whereElementId($value)
 * @method static Builder|Spread whereElementUuid($value)
 * @method static Builder|Spread whereId($value)
 * @method static Builder|Spread whereIsActive($value)
 * @method static Builder|Spread whereKey($value)
 * @method static Builder|Spread whereModuleId($value)
 * @method static Builder|Spread whereName($value)
 * @method static Builder|Spread whereNameExt($value)
 * @method static Builder|Spread whereProjectId($value)
 * @method static Builder|Spread whereRelatedId($value)
 * @method static Builder|Spread whereRelatesTo($value)
 * @method static Builder|Spread whereSlug($value)
 * @method static Builder|Spread whereSpreadableId($value)
 * @method static Builder|Spread whereSpreadableType($value)
 * @method static Builder|Spread whereTag($value)
 * @method static Builder|Spread whereTenantId($value)
 * @method static Builder|Spread whereUpdatedAt($value)
 * @method static Builder|Spread whereUpdatedBy($value)
 * @method static Builder|Spread whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Spread extends \App\Mainframe\Modules\Spreads\Spread
{
    use SpreadHelper;

    protected $moduleName = 'spreads';
    protected $table = 'spreads';

    /**
     * Disable auditing
     *
     * @var bool
     */
    public static $auditingDisabled = true;
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'spreadable_type', 'spreadable_id', 'module_id', 'element_id', 'element_uuid', 'key', 'tag', 'relates_to', 'related_id', 'is_active',];
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
        self::observe(SpreadObserver::class);
        // self::disableAuditing(); // Disable audit entry for this model.

        // static::saving(function (Spread $element) { });
        // static::creating(function (Spread $element) { });
        // static::updating(function (Spread $element) { });
        // static::created(function (Spread $element) { });
        // static::updated(function (Spread $element) { });
        // static::saved(function (Spread $element) { });
        // static::deleting(function (Spread $element) { });
        // static::deleted(function (Spread $element) { });
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
     * @return SpreadProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
