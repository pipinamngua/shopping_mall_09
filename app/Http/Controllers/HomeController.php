<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Order;
use App\Model\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    public function getMyOrder($id)
    {
        settype($id, 'int');
        $orders = Order::where('user_id', $id)->get();

        return view('customers.my_order', compact('orders'));
    }

    public function getMyOrderDetail($id)
    {
        try {
            settype($id, 'int');
            $orderDetail = OrderItem::where('order_id', $id)->get();

            return view('customers.order_detail', compact([
                'orderDetail'
            ]));
        } catch (Exception $e) {
            return App::abort(404);
        }
    }

    public function getDeleteOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            
            return redirect()->back();
        } catch (Exception $e) {
            return App::abort(404);
        }
    }
}
