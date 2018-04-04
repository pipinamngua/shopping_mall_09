<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCheckout;
use Auth;
use App\Model\User;
use App\Model\Order;
use App\Model\OrderItem;
use Session;
use Cart;
use DB;
use Mail;

class CheckoutController extends Controller
{
    var $email = '';

    public function postCheckout(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'delivery_information' => 'required|min:8',
            'phone' => 'required|numeric|min:10'
        ]);

        DB::beginTransaction();

        try {
            $name = $request->name;
            $email = $request->email;
            $address = $request->address;
            $delivery_information = $request->delivery_information;
            $phone = $request->phone;
            $message = $request->message;
            $total = Cart::subtotal(0);
            $total = str_replace(',', '.', $total);
            if (Auth::check()) {
                $user = User::findOrFail(Auth::user()->id);
                $order = new Order();

                $order->customer_name = $user->name;
                $order->customer_email = $user->email;
                $order->customer_phone = $phone;
                $order->customer_address = $address;
                $order->delivery_information = $delivery_information;
                $order->payment = 'COD';
                $order->message = $message;
                $order->total_price = $total;
                $order->status = 0;
                $order->user_id = $user->id;

                $order->save();

                $cartData = Cart::content();

                foreach ($cartData as $key => $data) {
                    $orderItem = new OrderItem();

                    $orderItem->order_id = $order->id;
                    $orderItem->quantity = $data->qty;
                    $orderItem->sold_price = $data->price;
                    $orderItem->product_id = $data->id;
                    $orderItem->image = $data->options->img;

                    $orderItem->save();
                }

                DB::commit();
            } else {
                $order = new Order();

                $order->customer_name = $name;
                $order->customer_email = $email;
                $order->customer_phone = $phone;
                $order->customer_address = $delivery_information;
                $order->delivery_information = $delivery_information;
                $order->payment = 'COD';
                $order->message = $message;
                $order->total_price = $total;
                $order->status = 1;

                $order->save();

                $cartData = Cart::content();

                foreach ($cartData as $key => $data) {
                    $orderItem = new OrderItem();

                    $orderItem->order_id = $order->id;
                    $orderItem->quantity = $data->qty;
                    $orderItem->sold_price = $data->price;
                    $orderItem->product_id = $data->id;
                    $orderItem->image = $data->options->img;

                    $orderItem->save();
                }

                DB::commit();
            }

            $this->email = $email;

            $data =  [
                'name' => $name,
                'email' => $email,
                'Cart' => Cart::content(),
                'total' => $total,
                'count' => Cart::count(),
                'mobile' => $phone,
                'address' => $delivery_information
            ];

            Mail::send('email.order', $data, function ($msg) {
                $msg->from('legiang15091995@gmail.com', 'Giang Le');
                $msg->to($this->email, 'Ahihi')->subject('Thank you for ordering our store');
            });

            Cart::destroy();

            return redirect()->back()->with('thongbao', 'Checkout success');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('loi', 'Checkout Fail');
        }
    }
}
