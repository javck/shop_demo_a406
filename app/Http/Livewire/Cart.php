<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $carts;
    public $subtotal;

    public function mount()
    {
        $this->reinit();
    }

    public function reinit()
    {
        $user = Auth::user();
        $this->carts = \Cart::session($user->id)->getContent();
        $this->subtotal = \Cart::session($user->id)->getSubtotal();
    }

    public function render()
    {
        return view('livewire.cart')->extends('layouts.site');
    }
}
