<?php

namespace App\Project\Modules\Users;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin Paginator */
class UserCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = UserResource::class;

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
