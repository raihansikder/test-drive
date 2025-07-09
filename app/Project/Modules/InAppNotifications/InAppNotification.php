<?php

namespace App\Project\Modules\InAppNotifications;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\InAppNotifications\InAppNotification
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $notifiable_type Class of the notifiable
 * @property int|null $notifiable_id
 * @property int|null $module_id
 * @property int|null $element_id
 * @property string|null $element_uuid
 * @property int|null $user_id Recipient user id
 * @property string|null $type
 * @property string|null $event Name of the event i.e. "appointment.created"
 * @property string|null $subtitle Subtitle the notification
 * @property string|null $body Main body of the notification
 * @property string|null $images JSON array of image URLs
 * @property string|null $data Additional JSON payload
 * @property int|null $order Can be useful for sequencing if needed
 * @property int|null $is_visible Flag to indicate whether this entry should be visible in the user notification list
 * @property int|null $announcement_id Announcement id from which it is generated
 * @property int|null $accepts_response Flag to indicate whether user can respond to this notification
 * @property string|null $response_options JSON to show response options
 * @property string|null $response Capture user response to an announcement
 * @property string|null $responded_at Capture user response datetime
 * @property string|null $read_at Set the time stamp when a user "marks as read"
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
 * @property-read mixed $data_json
 * @property-read mixed $images_json
 * @property-read mixed $response_json
 * @property-read mixed $response_options_json
 * @property-read \App\Module|null $linkedModule
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @property-read \App\User|null $user
 * @method static Builder|InAppNotification newModelQuery()
 * @method static Builder|InAppNotification newQuery()
 * @method static Builder|InAppNotification query()
 * @method static Builder|InAppNotification whereAcceptsResponse($value)
 * @method static Builder|InAppNotification whereAnnouncementId($value)
 * @method static Builder|InAppNotification whereBody($value)
 * @method static Builder|InAppNotification whereCreatedAt($value)
 * @method static Builder|InAppNotification whereCreatedBy($value)
 * @method static Builder|InAppNotification whereData($value)
 * @method static Builder|InAppNotification whereDeletedAt($value)
 * @method static Builder|InAppNotification whereDeletedBy($value)
 * @method static Builder|InAppNotification whereElementId($value)
 * @method static Builder|InAppNotification whereElementUuid($value)
 * @method static Builder|InAppNotification whereEvent($value)
 * @method static Builder|InAppNotification whereId($value)
 * @method static Builder|InAppNotification whereImages($value)
 * @method static Builder|InAppNotification whereIsActive($value)
 * @method static Builder|InAppNotification whereIsVisible($value)
 * @method static Builder|InAppNotification whereModuleId($value)
 * @method static Builder|InAppNotification whereName($value)
 * @method static Builder|InAppNotification whereNameExt($value)
 * @method static Builder|InAppNotification whereNotifiableId($value)
 * @method static Builder|InAppNotification whereNotifiableType($value)
 * @method static Builder|InAppNotification whereOrder($value)
 * @method static Builder|InAppNotification whereProjectId($value)
 * @method static Builder|InAppNotification whereReadAt($value)
 * @method static Builder|InAppNotification whereRespondedAt($value)
 * @method static Builder|InAppNotification whereResponse($value)
 * @method static Builder|InAppNotification whereResponseOptions($value)
 * @method static Builder|InAppNotification whereSlug($value)
 * @method static Builder|InAppNotification whereSubtitle($value)
 * @method static Builder|InAppNotification whereTenantId($value)
 * @method static Builder|InAppNotification whereType($value)
 * @method static Builder|InAppNotification whereUpdatedAt($value)
 * @method static Builder|InAppNotification whereUpdatedBy($value)
 * @method static Builder|InAppNotification whereUserId($value)
 * @method static Builder|InAppNotification whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class InAppNotification extends \App\Mainframe\Modules\InAppNotifications\InAppNotification
{
    use InAppNotificationHelper;

    protected $moduleName = 'in-app-notifications';
    protected $table = 'in_app_notifications';

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
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'notifiable_type', 'notifiable_id', 'module_id', 'element_id', 'name', 'user_id', 'type', 'event', 'subtitle', 'body', 'images', 'data', 'order', 'is_visible', 'announcement_id', 'accepts_response', 'response_options', 'response', 'responded_at', 'read_at', 'is_active',];
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
        self::observe(InAppNotificationObserver::class);
        // self::disableAuditing(); // Disable audit entry for this model.

        // static::saving(function (InAppNotification $element) { });
        // static::creating(function (InAppNotification $element) { });
        // static::updating(function (InAppNotification $element) { });
        // static::created(function (InAppNotification $element) { });
        // static::updated(function (InAppNotification $element) { });
        // static::saved(function (InAppNotification $element) { });
        // static::deleting(function (InAppNotification $element) { });
        // static::deleted(function (InAppNotification $element) { });
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
     * @return InAppNotificationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
