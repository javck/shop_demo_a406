<?php

namespace App\Http\Livewire;

use Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartItem extends Component
{
    public $cart;
    public $quantity;
    public $subtotal;

    public function cartUpdate($updateQty)
    {
        $user = Auth::user();
        $this->subtotal = $this->cart['price'] * $this->quantity;
        Cart::session($user->id)->update($this->cart['id'],['quantity'=>$updateQty]);
    }

    public function cartReset()
    {
        $user = Auth::user();
        $this->subtotal = $this->cart['price'] * $this->quantity;
        Cart::session($user->id)->remove($this->cart['id']);
        Cart::session($user->id)->add([
            'id' => $this->cart['id'],
            'name' => $this->cart['name'],
            'price' => $this->cart['price'],
            'quantity' => $this->quantity,
            'attributes' => array(),
            'associatedModel' => $this->cart['associatedModel']
        ]);
    }

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->quantity = $cart->quantity;
        $this->subtotal = $cart->price * $this->quantity;
    }

    public function plus()
    {
        if($this->quantity < 99){
            $this->quantity += 1;
        }
        $this->cartUpdate(1);
    }

    public function minus()
    {
        if($this->quantity > 1){
            $this->quantity -= 1;
        }
        $this->cartUpdate(-1);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
