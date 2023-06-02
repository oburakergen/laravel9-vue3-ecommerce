<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCardRequest;
use App\Http\Resources\BasketCollection;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BasketApi extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AddToCardRequest $request
     * @return JsonResponse
     */
    public function store(AddToCardRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $product = Product::isStock()->findOrFail($data["productId"]);
        } catch (\Exception $exception) {
            return response()->json(["message" => $exception->getMessage()],400);
        }

        $order = Order::where("user_id",$data["userId"])->first();

        if (!$order) {
            $order = Order::create([
                "user_id" => $data["userId"],
                "total_price" => $product->price,
                "total" => 1,
            ]);

            OrderDetail::create([
                "order_id" => $order->id,
                "product_id" => $data["productId"],
                "quantity" => 1,
            ]);
        } else {
            $detail = OrderDetail::where(["order_id" => $order->id, "product_id" => $data["productId"]])->first();

            if ($detail) {
                $quantity = ($product->quantity - $data["quantity"]) - $detail->quantity;
                $total = 1;
                $temp = $detail->quantity;

                if ($quantity < 0) {
                    $total = $product->quantity;
                } else {
                    $total =  $data["quantity"] + $detail->quantity;
                }

                $detail->quantity = $total;
                $detail->save();
                $order->total = $order->total + $detail->quantity - $temp;
                $order->save();
            } else {
                $order->total = $order->total + 1;
                $order->save();

                OrderDetail::create([
                    "order_id" => $order->id,
                    "product_id" => $data["productId"],
                    "quantity" => 1,
                ]);
            }
        }

        $response = new BasketCollection($order->details);

        return $response->response()->setStatusCode('200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $order = Order::where('user_id',$id)->first();
            OrderDetail::where('order_id', $order->id)->delete();
            $order->delete();
        } catch (\Exception $exception) {
            return response()->json(["message" => $exception->getMessage()],400);
        }

        return response()->json(["message" => "Cache Cleared"],200);
    }
}
