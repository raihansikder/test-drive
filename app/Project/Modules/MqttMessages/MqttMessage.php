<?php

namespace App\Project\Modules\MqttMessages;

use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Project\Features\Modular\BaseModule\BaseModule;

/**
 * 
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property int|null $device_id
 * @property string|null $device_uid
 * @property int|null $user_id
 * @property int|null $client_id
 * @property string|null $type
 * @property string|null $topic
 * @property string|null $body
 * @property int|null $is_processed
 * @property int|null $is_processable
 * @property string|null $processing_note
 * @property string|null $name_ext
 * @property string|null $slug
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read mixed $body_json
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\User|null $creator
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Project\Modules\MqttMessages\MqttMessage withoutTrashed()
 * @mixin \Eloquent
 */
class MqttMessage extends BaseModule
{
    use MqttMessageHelper, MqttMessageScope;

    protected $moduleName = 'mqtt-messages';
    protected $table = 'mqtt_messages';
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
        'device_id',
        'user_id',
        'client_id',
        'device_uid',
        'type',
        'topic',
        'body',
        'is_processed',
        'is_processable',
        'processing_note',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at']; // Deprecated in Laravel 10, use $casts
    // protected $casts = [];
    // protected $with = []; // Should be left empty!!
    protected $appends = ['body_json']; // Should be left empty!!
    protected $spreadFields = [];
    protected $tagFields = [];

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
        self::observe(MqttMessageObserver::class);

        // static::saving(function (MqttMessage $element) { });
        // static::creating(function (MqttMessage $element) { });
        // static::updating(function (MqttMessage $element) { });
        // static::created(function (MqttMessage $element) { });
        // static::updated(function (MqttMessage $element) { });
        // static::saved(function (MqttMessage $element) { });
        // static::deleting(function (MqttMessage $element) { });
        // static::deleted(function (MqttMessage $element) { });
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

    /**
     * Get the user's first name.
     */
    protected function bodyJson(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => json_decode($attributes['body']),
        );
    }
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
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return MqttMessageProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */

}
