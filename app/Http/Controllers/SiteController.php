<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function renderHomePage(Request $request)
    {
        $items = Item::get();
        return view('index',compact('items'));
    }

    public function addCart(Request $request, $id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($id);
        if($request->has('quantity')){
            $quantity = $request->quantity;
        }else{
            $quantity = 1;
        }
        $data = [
            'id' => $id,
            'name' => $item->title,
            'price' => $item->price,
            'quantity' => $quantity,
            'attributes' => array(),
            'associatedModel' => $item
        ];
        \Cart::session($user->id)->add($data);
        return redirect('/showcart');
    }

    // public function showCart()
    // {
    //     $user = Auth::user();
    //     $carts = \Cart::session($user->id)->getContent();
    //     return view('cart',compact('carts'));
    // }

    public function renderItemDetailPage($id){
        $item = Item::findOrFail($id);
        return view('product_detail',compact('item'));
    }

    public function renderCheckoutPage()
    {
        $user = Auth::user();
        $carts = \Cart::session($user->id)->getContent();
        $subtotal = \Cart::session($user->id)->getSubtotal();
        return view('checkout',compact('carts','subtotal'));
    }

    public function pay()
    {
        
    }
}
