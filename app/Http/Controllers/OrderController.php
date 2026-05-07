<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function markAsSettled(int $id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'settlement']);

        return redirect()->route('orders.index')->with('success', 'Order Code : ' . $order->order_code . ', Tanggal Order : ' . $order->created_at . ' marked as settled successfully.');
    }
}
