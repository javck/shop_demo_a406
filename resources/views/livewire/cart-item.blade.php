<tr>
    <td>
      <div class="media">
        <div class="d-flex">
          <img src="assets/img/gallery/card1.png" alt="" />
        </div>
        <div class="media-body">
          <p>{{ $cart['name'] }}</p>
        </div>
      </div>
    </td>
    <td>
      <h5>${{ $cart['price'] }}</h5>
    </td>
    <td>
      <div class="product_count">
        <span wire:click="minus"> <i class="ti-minus"></i></span>
        <input type="text" wire:model="quantity" wire:change="cartReset" />
        <span wire:click="plus"> <i class="ti-plus"></i></span>
      </div>
    </td>
    <td>
      <h5>${{ $subtotal }}</h5>
    </td>
  </tr>
