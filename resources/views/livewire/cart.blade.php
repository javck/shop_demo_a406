<div>
  <!-- Hero Area Start-->
  <div class="slider-area ">
      <div class="single-slider slider-height2 d-flex align-items-center">
          <div class="container">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="hero-cap text-center">
                          <h2>購物車清單</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">產品</th>
                <th scope="col">價格</th>
                <th scope="col">數量</th>
                <th scope="col">合計</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($carts as $cart)
                @livewire('cart-item', ['cart' => $cart], key($cart['id']))
              @endforeach
              <tr class="bottom_button">
                <td>
                  <button class="btn_1" wire:click="reinit">更新購物車</button>
                </td>
                <td></td>
                <td></td>
                <td>
                  {{-- <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div> --}}
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>小計</h5>
                </td>
                <td>
                  <h5>${{ $subtotal }}</h5>
                </td>
              </tr>
               {{-- 
              <tr class="shipping_area">
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
               <td>
                  <div class="shipping_box">
                    <ul class="list">
                      <li>
                        Flat Rate: $5.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li>
                        Free Shipping
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li>
                        Flat Rate: $10.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li class="active">
                        Local Delivery: $2.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                    </ul>
                    <h6>
                      Calculate Shipping
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </h6>
                    <select class="shipping_select">
                      <option value="1">Bangladesh</option>
                      <option value="2">India</option>
                      <option value="4">Pakistan</option>
                    </select>
                    <select class="shipping_select section_bg">
                      <option value="1">Select a State</option>
                      <option value="2">Select a State</option>
                      <option value="4">Select a State</option>
                    </select>
                    <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                    <a class="btn_1" href="#">Update Details</a>
                  </div>
                </td> 
              </tr>--}}
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="{{ url('/') }}">繼續購物</a>
            <a class="btn_1 checkout_btn_1" href="{{ url('checkout') }}">進行結帳</a>
          </div>
        </div>
      </div>
  </section>
</div>
