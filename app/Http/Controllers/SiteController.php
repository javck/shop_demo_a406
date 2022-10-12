<?php

namespace App\Http\Controllers;

use Cart;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\Order;
use App\Models\Element;
use App\Models\ItemOrder;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
        $this->checkout->setReturnUrl(url('pay/callback'));
        
        $this->middleware('auth')->except(['renderHomePage','renderItemDetailPage','payCallback','renderConfirmationPage']);
    }
    
    public function renderHomePage(Request $request)
    {
        $items = Item::get();
        $banners = Element::where('page','home')->where('position','banner')->where('enabled',true)->orderBy('sort','asc')->get();
        $items_row1 = Element::where('page','home')->where('position','row1')->where('enabled',true)->orderBy('sort','asc')->get();
        return view('index',compact('items','banners','items_row1'));
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

    public function renderConfirmationPage(Request $request,$order_id)
    {
        $order = Order::findOrFail($order_id);
        $items = $order->items;
        $quantity = 0;
        foreach ($items as $item) {
            $quantity = $quantity + $item->pivot->quantity;
        }
        return view('/confirmation',compact('order','items','quantity'));
    }

    //結帳路由方法
    public function pay()
    {
       //建立訂單&明細
        $items_cart = \Cart::session(Auth::user()->id)->getContent();
        $order = Order::create([
            'user_id' => Auth::user()->id
        ]);
        foreach ($items_cart as $item_cart) {
            ItemOrder::create(['order_id' => $order->id, 'item_id' => $item_cart->id, 'quantity' => $item_cart->quantity]);
        }

        //串接綠界金流做付款
        $formData = [
            'UserId' => Auth::user()->id, // 用戶ID , 非必須
            'MerchantTradeNo' => 'Goblin' . $order->id, //特店訂單編號
            'ItemDescription' => $order->title, //商品描述，可自己修改
            'ItemName' => 'Goblin Shop Items', //商品名稱，可自己修改
            'TotalAmount' => \Cart::session(Auth::user()->id)->getSubtotal(), //訂單總金額
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
            'CustomField1' => $order->id, //自定義欄位1
            'CustomField2' => Auth::user()->id //自定義欄位2
        ];
        return $this->checkout->setPostData($formData)->send();
    }

    //綠界付完款轉址路由方法
    public function payCallback(Request $request)
    {
        $userId = $request->CustomField2;
        \Cart::session($userId)->clear();
        $response = $request->all();
        $order = Order::find($response['CustomField1']);
        if ($response['RtnCode'] == 1) {
            if ($response['PaymentType'] == 'Credit_CreditCard') {
                $order->pay_type = 'credit';
            }
            $order->trade_no = $response['TradeNo']; //綠界訂單編號
            $order->pay_at = Carbon::createFromFormat('Y/m/d H:i:s',$response['PaymentDate']);
            $order->subtotal = $response['TradeAmt'];
            $order->status = 'paid';
            $order->save();
            Log::info('訂單編號' . $order->id . '付款成功');
        } else {
            Log::error('訂單編號' . $order->id . '付款失敗');
        }
        return redirect('/confirm/' . $order->id); //返回首頁
    }

    public function renderAboutPage()
    {
        return view('about');
    }

    public function renderContactPage()
    {
        return view('contact');
    }

    public function renderShopPage()
    {
        return view('shop');
    }

}
