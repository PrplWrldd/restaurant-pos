<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('checkout.index',compact('orders'));
    }
}
