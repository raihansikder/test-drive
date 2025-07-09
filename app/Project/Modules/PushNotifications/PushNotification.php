<?php

namespace App\Project\Modules\PushNotifications;

use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * App\Project\Modules\PushNotifications\PushNotification
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $user_id Recipient user id
 * @property string|null $device_token Firebase Device Identifier to target a user
 * @property int|null $in_app_notification_id Related in-app notification
 * @property int|null $order Can be used for ordering/sequencing sending
 * @property string|null $type Generic|Popup Type indicates the purpose or objective. It is often mapped with a paired
 *     in-app notification'
 * @property string|null $event Name of the event i.e. "appointment.created"
 * @property string|null $body Main body of the notification
 * @property string|null $data Additional JSON payload
 * @property string|null $api_response Full JSON response from the sender service
 * @property string|null $multicast_id Set from FCM response of send attempt. The existence of multicast_id indicates
 *     that attempt was successfully made. Fill from api_response
 * @property int|null $success_count Fill from api_response
 * @property int|null $failure_count Fill from api_response
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
 * @property-read mixed $api_response_json
 * @property-read mixed $data_json
 * @property-read \App\InAppNotification|null $inAppNotification
 * @property-read \App\Module $linkedModule
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @property-read \App\User|null $user
 * @method static Builder|PushNotification newModelQuery()
 * @method static Builder|PushNotification newQuery()
 * @method static Builder|PushNotification query()
 * @method static Builder|PushNotification whereApiResponse($value)
 * @method static Builder|PushNotification whereBody($value)
 * @method static Builder|PushNotification whereCreatedAt($value)
 * @method static Builder|PushNotification whereCreatedBy($value)
 * @method static Builder|PushNotification whereData($value)
 * @method static Builder|PushNotification whereDeletedAt($value)
 * @method static Builder|PushNotification whereDeletedBy($value)
 * @method static Builder|PushNotification whereDeviceToken($value)
 * @method static Builder|PushNotification whereEvent($value)
 * @method static Builder|PushNotification whereFailureCount($value)
 * @method static Builder|PushNotification whereId($value)
 * @method static Builder|PushNotification whereInAppNotificationId($value)
 * @method static Builder|PushNotification whereIsActive($value)
 * @method static Builder|PushNotification whereMulticastId($value)
 * @method static Builder|PushNotification whereName($value)
 * @method static Builder|PushNotification whereNameExt($value)
 * @method static Builder|PushNotification whereOrder($value)
 * @method static Builder|PushNotification whereProjectId($value)
 * @method static Builder|PushNotification whereSlug($value)
 * @method static Builder|PushNotification whereSuccessCount($value)
 * @method static Builder|PushNotification whereTenantId($value)
 * @method static Builder|PushNotification whereType($value)
 * @method static Builder|PushNotification whereUpdatedAt($value)
 * @method static Builder|PushNotification whereUpdatedBy($value)
 * @method static Builder|PushNotification whereUserId($value)
 * @method static Builder|PushNotification whereUuid($value)
 * @mixin \Eloquent
 * @method static Builder|BaseModule active()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 */
class PushNotification extends \App\Mainframe\Modules\PushNotifications\PushNotification
{
    use PushNotificationHelper;

    protected $moduleName = 'push-notifications';
    protected $table = 'push_notifications';

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
    // protected $fillable = ['project_id', 'tenant_id', 'uuid', 'name', 'user_id', 'device_token', 'in_app_notification_id', 'order', 'type', 'event', 'body', 'data', 'api_response', 'multicast_id', 'success_count', 'failure_count', 'is_active',];
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
        self::observe(PushNotificationObserver::class);
        // self::disableAuditing(); // Disable audit entry for this model.

        // static::saving(function (PushNotification $element) { });
        // static::creating(function (PushNotification $element) { });
        // static::updating(function (PushNotification $element) { });
        // static::created(function (PushNotification $element) { });
        // static::updated(function (PushNotification $element) { });
        // static::saved(function (PushNotification $element) { });
        // static::deleting(function (PushNotification $element) { });
        // static::deleted(function (PushNotification $element) { });
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
     * @return PushNotificationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor() { return parent::processor(); }

}
