<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCardRequest;
use App\Http\Resources\BasketCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = new ProductCollection(Product::where('price', '>','0')->Limit(50)->order()->get());

        return $data->response()->setStatusCode(200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $transaction = Transaction::where("order_id",$id)->first();

       if ($transaction->status === 'process') {
           $transaction->status = 'success';
           $transaction->save();

           $transaction = Transaction::join("orders", "transactions.order_id", "=", "orders.id")->get();

           return response()->json($transaction,200);
       } else {
           return response()->json([
               "message" => "Status must be process"
           ], 400);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
