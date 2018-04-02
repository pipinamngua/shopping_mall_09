<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Auth;
use Cart;

class CartController extends Controller
{
    public function getAddCart(Request $request)
    {
        try{
            if ($request->ajax()) {
                $id = $request->idProduct;
                $itemPrice = $request->itemPrice;
                $product_buy = Product::findOrFail($id);
                $image = $product_buy->image_path;
                Cart::add([
                    'id' => $id,
                    'name' => $product_buy->product_name,
                    'qty' => 1,
                    'price' => $itemPrice,
                    'options' => ['img' => $image],
                ]);
                $total = Cart::subtotal(0);
                $total = str_replace(',', '.', $total);
                $countCart = Cart::count();

                return response()->json([
                    'total' => $total,
                    'countCart' => $countCart
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ]);
        }
    }

    public function getCart()
    {
        $total = Cart::subtotal(0);
        $total = str_replace(',', '.', $total);
        $countCart = Cart::count();

        return response()->json([
            'total' => $total,
            'countCart' => $countCart
        ]);
    }

    public function getShowCart()
    {
        $cartContents = Cart::content();
        $cartTotal = Cart::subtotal(0);

        return view('customers.basket', compact([
            'cartContents',
            'cartTotal'
        ]));
    }

    public function getUpdateCart(Request $request)
    {
        $qtyUpdate = $request->qtyUpdate;
        $rowID = $request->rowID;
        Cart::update($rowID, $qtyUpdate);
        $data = Cart::get($rowID);

        return response()->json([
            'data' => $data
        ]);
    }

    public function getDeleteCart(Request $request)
    {
        $idCart = $request->idCart;
        if (Cart::get($idCart)) {
            Cart::remove($idCart);

            return response()->json('1');
        }

        return response()->json('0');
    }
}
