<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\OrderItem;
use App\Model\Order;
use App;

class OrderDetailController extends Controller
{
    public function getListOrderDetail($id)
    {   
        try {
            settype($id, 'int');
            $order = Order::findOrFail($id);
            $orderDetail = OrderItem::where('order_id', $id)->get();

            return view('admin.order.detail', compact([
                'orderDetail',
                'order'
            ]));
        } catch (Exception $e) {
            return App::abort(404);
        }
    }

    public function getUpdateStatusOrder(Request $request)
    {
        try {
            $status = $request->status;
            $idOrder = $request->idOrder;
            $order = Order::findOrFail($idOrder);

            if ($status == 0) { // Trạng thái Đang Chờ
                $order->status = 0;
                $order->save();

                return response()->json('Đang Chờ');
            } elseif ($status == 1) { // Trạng thái Xác Nhận
                $order->status = 1;
                $order->save();

                return response()->json('Xác Nhận');
            } elseif ($status == 2) { // Trạng thái Hoàn Thành
                $order->status = 2;
                $order->save();

                return response()->json('Hoàn Thành');
            } else { //trạng thái hủy bỏ
                $order->status = 3;
                $order->save();

                return response()->json('Hủy Bỏ');
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ]);
        }
    }
}
