<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $isChecked = false;

    public function render()
    {
        return view('livewire.checkout');
    }
}
