<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('kitchen.index', compact('orders'));
    }

    public function create()
    {
        $menuItems = MenuItem::all();
        return view('menu.index', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->items = json_encode($request->items);
        $order->save();
        return redirect()->route('orders.create')->with('success', 'Order placed successfully.');
    }

    public function show(Order $order)
    {
        return view('kitchen.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->status = 'completed';
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order completed.');
    }
}
