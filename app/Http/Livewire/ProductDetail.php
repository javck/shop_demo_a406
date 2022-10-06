<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class ProductDetail extends Component
{
    public Item $item;
    public $quantity = 1;
    public $total = 0;

    public function mount($item)
    {
        $this->item = $item;
        $this->total = $item->price * $this->quantity;
    }

    public function plus()
    {
        $this->quantity += 1;
        $this->total = $this->item->price * $this->quantity;
    }

    public function minus()
    {
        if($this->quantity > 1){
            $this->quantity -= 1;
            $this->total = $this->item->price * $this->quantity;
        }
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
