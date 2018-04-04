<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    public function getListOrder()
    {
        $orders = Order::all();
        return view('admin.order.list', compact('orders'));
    }
}
