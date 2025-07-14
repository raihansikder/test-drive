<?php

namespace App\Project\Modules\MqttMessages;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin Paginator */
class MqttMessageCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = MqttMessageResource::class;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
