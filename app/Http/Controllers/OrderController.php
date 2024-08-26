<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->table_id = $request->table_id;
        $order->order_details = json_encode($request->order_details);
        $order->total_price = $request->total_price;
        $order->status = 'pending';
        $order->save();

        return response()->json(['message' => 'Order placed successfully']);
    }
}

