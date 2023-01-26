@extends('frontend.master')
@section('header_css')
<link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/jquery.nice-number.min.css">
@endsection
@section('content')
<main>
  <!-- Bradcum Here -->
  <div class="container my-3">
    <nav aria-label="breadcrumb my-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add to Cart</li>
      </ol>
    </nav>
  </div>

  @php
  $cart = getCart()
  @endphp

  <section id="cart_view">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-12 col-sm-12 col-md-12">
          <div class="cart_item_heading">
            <h5>My Cart ({{ count($cart['cart']) }} Items) </h5>
          </div>
          <div class="cart_list">
            @foreach($cart['cart'] as $key => $item)
            <div class="cart_item_details">
              <div class="cart_pro_img">
                <img src="{{ asset('backend/uploads/' . $item['product_url']) }}" alt="Product image">
              </div>
              <div class="cart_pro_text">
                <p class="item_name">{{ $item['product_name'] }}</p>
                <a href="{{ url('remove-cart-item/' . $key) }}"><i class="far fa-trash-alt"></i></a>
              </div>
              <div class="cart_text_tk">
                <input type="number" placeholder="1" value="{{ $item['quantity'] }}" min="0">
                <h6>SA {{ ($item['product_price'] * $item['quantity']) - $item['discount'] }}</h6>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="col-lg-12 col-12 col-sm-12 col-md-12">
          <div class="checkout_text">
            <h6 class="total">Total Amount <span> SA {{ $cart['total'] }}</span></h6>
            <div class="checkout-btn">
              <a href="" class="btn common-btn">Proceed to Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!------------------------------- 
           Subscription Section
    -------------------------------->
  <section id="subscription">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-12 p-md-4">
          <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
              <div class="subscribe-content">
                <h2>Get your update news</h2>
                <p>We connect the dots.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-5">
              <form action="" class="subscribe-from">
                <div class="input-group">
                  <input class="form-control subscribe-input" type="email" placeholder="Put Your Email">
                  <button class="subscribe-btn" type="submit">Subscribe</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
@section('footer_js')
<!-- Nice Number -->
<script src="{{ asset('/frontend/assets/') }}/js/jquery.nice-number.min.js"></script>
@endsection