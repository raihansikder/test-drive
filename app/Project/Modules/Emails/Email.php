<?php

namespace App\Project\Modules\Emails;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\Emails\Email
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property int|null $tenant_sl
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property array|null $to
 * @property array|null $cc
 * @property array|null $bcc
 * @property string|null $subject
 * @property string|null $html
 * @property string|null $status_name
 * @property int|null $attempts
 * @property string|null $last_attempted_at
 * @property string|null $successfully_delivered_at
 * @property int|null $to_user_id
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $emailable_type
 * @property int|null $emailable_id
 * @property string|null $attachments
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static Builder|BaseModule active()
 * @method static Builder|Email newModelQuery()
 * @method static Builder|Email newQuery()
 * @method static Builder|Email query()
 * @method static Builder|Email whereAttachments($value)
 * @method static Builder|Email whereAttempts($value)
 * @method static Builder|Email whereBcc($value)
 * @method static Builder|Email whereCc($value)
 * @method static Builder|Email whereCreatedAt($value)
 * @method static Builder|Email whereCreatedBy($value)
 * @method static Builder|Email whereDeletedAt($value)
 * @method static Builder|Email whereDeletedBy($value)
 * @method static Builder|Email whereElementId($value)
 * @method static Builder|Email whereEmailableId($value)
 * @method static Builder|Email whereEmailableType($value)
 * @method static Builder|Email whereHtml($value)
 * @method static Builder|Email whereId($value)
 * @method static Builder|Email whereIsActive($value)
 * @method static Builder|Email whereLastAttemptedAt($value)
 * @method static Builder|Email whereModuleId($value)
 * @method static Builder|Email whereName($value)
 * @method static Builder|Email whereNameExt($value)
 * @method static Builder|Email whereProjectId($value)
 * @method static Builder|Email whereSlug($value)
 * @method static Builder|Email whereStatusName($value)
 * @method static Builder|Email whereSubject($value)
 * @method static Builder|Email whereSuccessfullyDeliveredAt($value)
 * @method static Builder|Email whereTenantId($value)
 * @method static Builder|Email whereTenantSl($value)
 * @method static Builder|Email whereTo($value)
 * @method static Builder|Email whereToUserId($value)
 * @method static Builder|Email whereUpdatedAt($value)
 * @method static Builder|Email whereUpdatedBy($value)
 * @method static Builder|Email whereUuid($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $emailable
 * @property-read \App\Module|null $relatedModule
 */
class Email extends \App\Mainframe\Modules\Emails\Email
{
    use EmailHelper;

    protected $moduleName = 'emails';
    protected $table = 'emails';

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
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'name_ext', 'slug', 'to', 'cc', 'bcc', 'subject', 'html', 'status_name', 'attempts', 'last_attempted_at', 'successfully_delivered_at', 'to_user_id', 'module_id', 'element_id', 'emailable_type', 'emailable_id', 'attachments', 'is_active',];
    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = ['to' => 'array', 'cc' => 'array', 'bcc' => 'array',];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(EmailObserver::class);

        // static::saving(function (Email $element) { });
        // static::creating(function (Email $element) { });
        // static::updating(function (Email $element) { });
        // static::created(function (Email $element) { });
        // static::updated(function (Email $element) { });
        // static::saved(function (Email $element) { });
        // static::deleting(function (Email $element) { });
        // static::deleted(function (Email $element) { });
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
     * @return EmailProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
