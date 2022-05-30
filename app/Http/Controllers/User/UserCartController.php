<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    //
    function show()
    {
        return view('user.cart.show');
    }

    function addCart(Request $request, $id)
    {
        if ($request->input('num-order') > 0) {
            $product_by_id = Products::find($id);
            $qty = $request->input('num-order');
            Cart::add([
                'id' => $product_by_id->id,
                'name' => $product_by_id->name,
                'qty' => $qty,
                'price' => $product_by_id->price,
                'options' => [
                    'images' => $product_by_id->images,
                ],
            ]);
            echo "<pre>";
            print_r(Cart::content());
            echo "</pre>";
            return redirect(route('cart.show'));
        } else {
            return back()->with("info", "Số lượng phải > hơn 0!");
        }
    }

    function checkout(Request $request)
    {
        return view('user.cart.checkout');
    }


    function delete($rowId)
    {
        if ($rowId == 'all') {
            Cart::destroy();
            return redirect(route('cart.show'));
        } else {
            Cart::remove($rowId);
            return redirect(route('cart.show'));
        }
    }

    function updateCart(Request $request){
        $rowId = $request->input('rowId_cart');
        $qty = $request->input('qty');
        Cart::update($rowId,$qty);
        return redirect(route('cart.show'));
    }
}
