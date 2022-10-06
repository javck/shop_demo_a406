@extends('layouts.site')

@section('content')
<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>訂單確認</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================ confirmation part start =================-->
<section class="confirmation_part section_padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="confirmation_tittle">
          <span>謝謝你，你的訂單已經成立.</span>
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>訂單資訊</h4>
          <ul>
            <li>
              <p>單號</p><span>: {{$order->trade_no}}</span>
            </li>
            <li>
              <p>日期</p><span>: {{ $order->created_at->format('Y-m-d') }}</span>
            </li>
            <li>
              <p>合計</p><span>: TWD {{ $order->subtotal }}</span>
            </li>
            <li>
              <p>付款方式</p><span>: {{ $order->pay_type }}</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>Billing Address</h4>
          <ul>
            <li>
              <p>Street</p><span>: 56/8</span>
            </li>
            <li>
              <p>city</p><span>: Los Angeles</span>
            </li>
            <li>
              <p>country</p><span>: United States</span>
            </li>
            <li>
              <p>postcode</p><span>: 36952</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-lx-4">
        <div class="single_confirmation_details">
          <h4>shipping Address</h4>
          <ul>
            <li>
              <p>Street</p><span>: 56/8</span>
            </li>
            <li>
              <p>city</p><span>: Los Angeles</span>
            </li>
            <li>
              <p>country</p><span>: United States</span>
            </li>
            <li>
              <p>postcode</p><span>: 36952</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="order_details_iner">
          <h3>訂單明細</h3>
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col" colspan="2">商品</th>
                <th scope="col">數量</th>
                <th scope="col">合計</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <th colspan="2"><span>{{ $item->title }}</span></th>
                <th>x{{ $item->pivot->quantity }}</th>
                <th> <span>${{ $item->price * $item->pivot->quantity }}</span></th>
              </tr>
              @endforeach
              
              <tr>
                <th colspan="3">小計</th>
                <th> <span>${{ $order->subtotal }}</span></th>
              </tr>
              <tr>
                <th colspan="3">運費</th>
                <th><span>flat rate: $0</span></th>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col" colspan="2">數量</th>
                <th scope="col">x{{ $quantity }}</th>
                <th scope="col">${{ $order->subtotal }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ confirmation part end =================-->    
@endsection