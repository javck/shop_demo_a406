<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function renderHomePage(Request $request)
    {
        $items = Item::get();
        return view('index',compact('items'));
    }

    public function addCart(Request $request)
    {
        return view('cart');
    }

    public function renderItemDetailPage($id){
        $item = Item::findOrFail($id);
        return view('product_detail',compact('item'));
    }
}
