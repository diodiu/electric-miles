<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(IndexOrderRequest $request)
    {
        $params = $request->all();
        if (isset($params['status'])) {
            return Order::where('status', '=', $params['status'])->get();
        }

        if (isset($params['id'])) {
            return Order::find($params['id']);
        }

        return Order::all();
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::make($request->all());
        $user = Auth::user();
        $order->customer_id = $user->id;
        $order->save();

        $items = $request->all()['items'];
        foreach ($items as $item) {
            OrderItem::create([
                'item_id' => $item['id'],
                'order_id' => $order->id,
                'quantity' => $item['quantity']
            ]);
        }

        return response(['expectedTimeOfDelivery' => $order->expectedTimeOfDelivery], Response::HTTP_CREATED);
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->status = $request->all()['status'];
        $order->save();

        return $order;
    }
}
