<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('orders.index',compact('orders'));
    }
    public function show(Order $order)
    {
        $this->authorize('view',$order);

        $items = Cart::content();
        return view('orders.show',compact('order','items'));
    }
}
