<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|int',
        ]);

        if ($validator->fails()) {
            return apiResponse(422, $validator->errors(), 'Validation error');
        }

        $order = Order::create($validator->validated());

        return apiResponse(200, $order, 'Order created');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|int'
        ]);

        $order->order_status_id = $request->status;
        $order->save();

        return apiResponse(200, $order, 'Order status updated');
    }

    public function index(Request $request)
    {


        $query = Order::query();

        if ($request->has('status')) {
            $query->where('order_status_id', $request->status);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        $ord = [];

        foreach ($orders as $id => $item) {
            $ord[$id]['id'] = $item->id;
            $ord[$id]['name'] = $item->name;
            $ord[$id]['price'] = $item->price;
            $ord[$id]['status'] = $item->orderstatus->name;
            $ord[$id]['status_id'] = $item->orderstatus->id;
        }

        $orderstatus = OrderStatus::query()->get()->toArray();

        return apiResponse(200, (['ord' => $ord, 'orderstatus' => $orderstatus]), 'Orders fetched');
    }
}
