<?php

namespace App\Project\Modules\Users;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    /*
    |--------------------------------------------------------------------------
    | Define a API resource structure.
    |--------------------------------------------------------------------------
    */
    /**
     * @var User
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Include all fields
        // Use model $hidden attribute to hide sensitive fields
        return $this->resource->toArray();

        // # OR - Customize the JSON field based on project requirement
        // return [
        //     'id' => $this->id,
        //     'uuid' => $this->uuid,
        //     'name' => $this->name,
        //     'created_at' => $this->created_at,
        //     'created_by' => $this->created_by,
        //     'updated_at' => $this->updated_at,
        //     'updated_by' => $this->updated_by,
        //     'is_active' => $this->is_active,
        // ];
    }
}
