<?php

namespace App\Project\Modules\Contents;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Contents\Content
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $key
 * @property string|null $title
 * @property string|null $body
 * @property string|null $parts JSON structure for additional dynamic parts
 * @property string|null $help_text Hint for how/where this is used
 * @property string|null $tags tags/spreadable
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
 * @property-read mixed $parts_array
 * @property-read \App\Module $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|Content newModelQuery()
 * @method static Builder|Content newQuery()
 * @method static Builder|Content query()
 * @method static Builder|Content whereBody($value)
 * @method static Builder|Content whereCreatedAt($value)
 * @method static Builder|Content whereCreatedBy($value)
 * @method static Builder|Content whereDeletedAt($value)
 * @method static Builder|Content whereDeletedBy($value)
 * @method static Builder|Content whereHelpText($value)
 * @method static Builder|Content whereId($value)
 * @method static Builder|Content whereIsActive($value)
 * @method static Builder|Content whereKey($value)
 * @method static Builder|Content whereName($value)
 * @method static Builder|Content whereNameExt($value)
 * @method static Builder|Content whereParts($value)
 * @method static Builder|Content whereProjectId($value)
 * @method static Builder|Content whereSlug($value)
 * @method static Builder|Content whereTags($value)
 * @method static Builder|Content whereTenantId($value)
 * @method static Builder|Content whereTitle($value)
 * @method static Builder|Content whereUpdatedAt($value)
 * @method static Builder|Content whereUpdatedBy($value)
 * @method static Builder|Content whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class Content extends \App\Mainframe\Modules\Contents\Content
{
    use ContentHelper;

    protected $moduleName = 'contents';
    protected $table = 'contents';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'key', 'title', 'body', 'parts', 'help_text', 'tags', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = ['parts_array'];
    // protected $tagFields = ['tags'];

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
        self::observe(ContentObserver::class);

        // static::saving(function (Content $element) { });
        // static::creating(function (Content $element) { });
        // static::updating(function (Content $element) { });
        // static::created(function (Content $element) { });
        // static::updated(function (Content $element) { });
        // static::saved(function (Content $element) { });
        // static::deleting(function (Content $element) { });
        // static::deleted(function (Content $element) { });
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
     * @return ContentProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
