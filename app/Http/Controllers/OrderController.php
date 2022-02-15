<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id);
        if(request('status')){
            $orders->where('status', request('status')); //accedemos a la variable status de la uri para saber cual devolver
        }
        $orders->get();

        for ($i = 1; $i <= 5; $i++){
            $ordersByStatus[$i] = Order::where('user_id', auth()->user()->id)->where('status',$i)->count();
        }
        return view('orders.index',compact('orders','ordersByStatus'));
    }
    public function show(Order $order)
    {
        $this->authorize('view',$order);

        $items = Cart::content();
        return view('orders.show',compact('order','items'));
    }
}
