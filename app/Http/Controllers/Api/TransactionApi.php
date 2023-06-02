<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Jobs\SendSmsJob;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $transaction = Transaction::join("orders", "transactions.order_id", "=", "orders.id")->get();

        return response()->json($transaction,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $order = Order::where("user_id", $data["userId"])->first();

        $transaction = Transaction::create([
            "name" => $data["name"],
            "lastname" => $data["lastname"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "order_id" => $order->id,
        ]);

        SendSmsJob::dispatch($transaction);

        return response()->json(["message" => $transaction->id], 200);
    }
}
