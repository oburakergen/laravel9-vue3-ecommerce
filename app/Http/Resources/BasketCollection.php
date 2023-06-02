<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class BasketCollection extends ResourceCollection
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
            $product = Product::find($data->product_id);

            return collect([
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $data->quantity,
                'image' => $product->image,
                'id' => $product->id,
            ]);
        });
    }
}
