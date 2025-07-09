<?php

namespace App\Mainframe\Features\Audit;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Mainframe\Features\Audit\Audit
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property string|null $user_type
 * @property int|null $user_id
 * @property string $event
 * @property string $auditable_type
 * @property int $auditable_id
 * @property array|null $old_values
 * @property array|null $new_values
 * @property string|null $url
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $auditable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 * @method static Builder|Audit newModelQuery()
 * @method static Builder|Audit newQuery()
 * @method static Builder|Audit query()
 * @method static Builder|Audit whereAuditableId($value)
 * @method static Builder|Audit whereAuditableType($value)
 * @method static Builder|Audit whereCreatedAt($value)
 * @method static Builder|Audit whereEvent($value)
 * @method static Builder|Audit whereId($value)
 * @method static Builder|Audit whereIpAddress($value)
 * @method static Builder|Audit whereName($value)
 * @method static Builder|Audit whereNewValues($value)
 * @method static Builder|Audit whereOldValues($value)
 * @method static Builder|Audit whereProjectId($value)
 * @method static Builder|Audit whereTags($value)
 * @method static Builder|Audit whereTenantId($value)
 * @method static Builder|Audit whereUpdatedAt($value)
 * @method static Builder|Audit whereUrl($value)
 * @method static Builder|Audit whereUserAgent($value)
 * @method static Builder|Audit whereUserId($value)
 * @method static Builder|Audit whereUserType($value)
 * @method static Builder|Audit whereUuid($value)
 * @mixin \Eloquent
 */
class Audit extends \OwenIt\Auditing\Models\Audit
{
    // use ModularTrait;

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Audit $element) {
            $element->uuid = uuid();
            $element->auditable_type = 'App\\'.class_basename($element->auditable_type); // Fill with root model
            $element->name = class_basename($element->auditable_type).' '.$element->event;
            $element->project_id = optional($element->auditable)->project_id;
            $element->tenant_id = optional($element->auditable)->tenant_id;
            // $element->fillModuleAndElement('auditable');
        });
    }

}
