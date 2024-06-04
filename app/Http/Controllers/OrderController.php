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
    
    public function completed()
    {
        $completedOrders = Order::completed()->get();

        if (request()->ajax()) {
            return view('kitchen.partials.completed-orders', compact('completedOrders'))->render();
        }
        
        return view('kitchen.completed', compact('completedOrders'));
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
    public function markAsCompleted(Request $request, Order $order)
    {
        $order->status = 'completed';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order marked as completed.']);
    }
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('message', 'Order successfully deleted.');
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
