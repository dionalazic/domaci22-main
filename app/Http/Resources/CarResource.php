<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'car';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'model'=>$this->resource->model,
            'year'=>$this->resource->year,
            'manufacturer'=> new ManufacturerResource($this->manufacturer),
            'user'=>new UserResource($this->resource->user),
        ];
    }
}
