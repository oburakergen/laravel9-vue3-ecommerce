<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection->map(function ($data) {
            return collect([
                'name' => $data->name,
                'price' => $data->price,
                'quantity' => $data->quantity,
                'image' => $data->image,
                'id' => $data->id,
            ]);
        });
    }
}
