<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        return view('admin.menu.index', compact('menuItems'));
    }

    public function store(Request $request)
    {
            // Check if any item has a quantity greater than 0
        $hasQuantity = collect($request->items)->contains(function ($value, $key) {
            return (int)$value > 0;
        });

        if (!$hasQuantity) {
            session()->flash('message2', 'No order was placed. Please enter a quantity.');
            return redirect()->route('menu-items.index');
        }
        $order = new Order();
        $order->items = json_encode($request->items);
       

        // Calculate the total price
        $totalPrice = 0;
        foreach ($request->items as $itemId => $quantity) {
        $menuItem = MenuItem::find($itemId);
        if ($menuItem) {
            $totalPrice += $menuItem->price * $quantity;
            }
        }

        $order->total_price = $totalPrice;
        $orderSaved = $order->save();
        
        // Save order details in a cookie
        $orders = json_decode(Cookie::get('user_orders', '[]'), true);
        $orders[] = $order->id;
        Cookie::queue('user_orders', json_encode($orders), 60 * 24 * 7); // Store for 7 days

        if ($orderSaved) {
            // Include the total price in the success message
            session()->flash('message1', 'Order placed successfully. Total price: RM' . $totalPrice);
        } else {
            session()->flash('message', 'No order was placed.');
        }
    
        return redirect()->route('menu-items.index')->with('success', 'Order placed successfully. Total price: RM' . $totalPrice);
        
    }

    public function userOrders()
    {
        $orderIds = json_decode(Cookie::get('user_orders', '[]'), true);
        $orders = Order::whereIn('id', $orderIds)->get();

        return view('menu.pickup', compact('orders'));
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
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('message', 'Order successfully deleted.');
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

   
}
