@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/jquery.nice-number.min.css">
@endsection
@section('content')

<main>
  @php
  $cart = getCart()
  @endphp

  <section>
    <div class="container">
      <div class="row breadcrumb-main">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
          <ul>
            <li>{{ session('error') }}</li>
          </ul>
        </div>
        @endif


        <div class="col-lg-7 p-0 left">
          <form action="{{ route('orderPlace') }}" method="post" id="orderPlace">
            @csrf
            <div class="shipping-form">
              <div class="heading-checkout">
                <h4>Billing Details</h4>
              </div>
              <div class="row mt-3 g-3">
                <div class="col-lg-12">
                  <label for="fullName" class="form-label">Full Name</label>
                  <input type="text" name="full_name" class="form-control" id="fullName"
                    value="{{ Auth::user()->name }}" disabled>
                </div>
                <div class="col-lg-6">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                    disabled>
                </div>
                <div class="col-5 col-md-6 col-lg-6">
                  <label for="phone" class="form-label">Phone Number</label>

                  <input type="text" class="form-control" id="inputAddress" name="phone"
                    value="{{ Auth::user()->phone }}" disabled>
                </div>
                <div class="col-lg-5 col-md-6">
                  <label for="state" class="form-label">State</label>
                  <select id="state" name="state" class="form-select state">
                    <option selected hidden disabled value="">Choose State</option>
                    @foreach($states as $state)
                    @if(old('state') == $state->name)
                    <option value="{{ $state->id }}" selected>{{ $state->name }}

                    </option>
                    @else
                    <option value="{{ $state->id }}">{{ $state->name }}

                    </option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-md-6">
                  <label for="city" class="form-label">City</label>
                  <select name="city" id="city" class="form-select city">
                    <option selected hidden disabled value="">Choose City</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-6">
                  <label for="inputZip" class="form-label">Postal Code</label>
                  <input type="text" name="postal_code" class="form-control" id="inputZip"
                    value="{{ old('postal_code') ?? (Auth::user()->userDetail ? Auth::user()->userDetail->postal_code : '') }}">
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" id="address"
                    placeholder="Apartment, studio, or floor"
                    value="{{ old('address') ?? (Auth::user()->userDetail ? Auth::user()->userDetail->address : '') }}">
                </div>

                <div class="col-12">
                  <label for="orderNotes" name="note" class="form-label">Order Notes</label>
                  <textarea class="form-control" name="note" id="orderNotes"
                    placeholder="Note About Your Order..."></textarea>
                </div>
              </div>
            </div>

            <div class="payment-method">
              <div class="heading-checkout">
                <h4>Select Payment Method</h4>
              </div>

              <ul class="payment-method-list">
                <li>
                  <input name="payment_method" id="card" type="radio" value="Card" checked>
                  <label for="card">Pay Card</label>
                </li>
                @if($is_cash_available != 0)
                  <li>
                    <input name="payment_method" id="delivery" type="radio" value="COD" checked>
                    <label for="delivery">Cash on Delivery</label>
                  </li>
                @endif
              </ul>
            </div>
          </form>
        </div>

        <div class="col-lg-5 p-0 right">
          <div class="order-summary">
            <div class="heading-checkout">
              <h4>Your Order Items</h4>
            </div>
            @foreach($cart['cart'] as $key => $item)
            <div class="row order-item">
              <div class="col-3 text-start0">
                <img class="rounded w-75" src="{{ asset('backend/uploads/' . $item['product_url']) }}" alt="product">
              </div>
              <div class="col-6">
                <p>{{ $item['product_name'] }}</p>
                <p>
                  <small>
                    (Color: {{ ucfirst($item['color']) }}, Size: {{ ucfirst($item['size']) }})
                  </small>
                </p>
                <p>Quanity: {{ $item['quantity'] }}</p>
              </div>
              <div class="col-3 text-end">
                <p>SA {{ number_format(($item['product_price'] * $item['quantity']) - $item['discount'], 2) }}</p>
              </div>
            </div>
            @endforeach
          </div>

          @php
          $coupon = Session::get('coupon');
          @endphp

          <div class="order-calculation">
            <div class="heading-checkout">
              <h4>Apply Coupon</h4>
            </div>
            @php
            $coupon = Session::get('coupon');
            @endphp
            <div class="checkout_text">
              <form class="apply-coupon" action="{{ route('coupon') }}" method="POST">
                @csrf
                <input type="text" @if($coupon) disabled @endif name="coupon"
                  value="{{ $coupon ? $coupon['code'] : old('coupon') }}">
                @if($coupon)
                <a href="{{ url('/remove-coupon') }}" id="coupon_btn">Remove</a>
                @else
                <button type="submit" id="coupon_btn">Apply</button>
                @endif
              </form>
            </div>
          </div>

          <div class="order-calculation">
            <div class="heading-checkout">
              <h4>Payment Calculation</h4>
            </div>
            <div class="row mt-3 g-3">
              <div class="col-6">
                <h6>Subtotal:</h6>
              </div>
              <div class="col-6">
                <h6 class="price-text sub-total-text text-end"> SA {{ number_format($cart['total'], 2) }}</h6>
              </div>

              <div class="col-6">
                <h6>Shipping Cost:</h6>
              </div>

              <!-- Shipping cost backend theke asbe -->
              <div class="col-6">
                <h6 class="price-text sub-total-text text-end"> SA {{ $shippingCost }}</h6>
              </div>

              @php
              $newtax = $cart['total'] * $tax / 100 ;
              @endphp

              @if(!empty($tax))
              <div class="col-6">
                <h6>Tax: {{ $tax }}%</h6>
              </div>
              @endif
              <div class="col-6">
                <h6 class="price-text sub-total-text text-end"> SA {{ number_format($newtax, 2) }} </h6>
              </div>

              <div class="col-6">
                <h6>Coupon Discount:({{ $coupon ? $coupon['code'] : 'No coupon' }})</h6>
              </div>

              <div class="col-6">
                <h6 class="price-text sub-total-text text-end"> SA {{ number_format($coupon ? $coupon['discount'] : 0,
                  2) }} </h6>
              </div>
              <hr>
              <div class="col-6">
                <h5>Total Amount</h5>
              </div>
              <div class="col-6">
                <h5 class="price-text sub-total-text text-end"> SA {{ number_format(($cart['total'] + $shippingCost +
                  $newtax) -
                  ($coupon
                  ?
                  $coupon['discount'] : 0), 2) }}</h5>
              </div>
            </div>
          </div>
          <div class="place-order">
            <button class="place-order-button" id="placeOrder" type="button" onclick="handleSubmit()">
              Place Order
            </button>

            <button class="place-order-button" id="loading" type="button" style="display: none">
              <span class="spinner-border spinner-border-sm"></span>
              Loading...
            </button>
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

<script>
  $('#state').change(function () {
    var stateId = $(this).val();
    if (stateId) {
      $.ajax({
        type: "GET",
        url: "{{url('get-cities')}}/" + stateId,
        success: function (res) {
          if (res) {
            $("#city").empty();
            $("#city").append('<option>Choose City</option>');
            $.each(res, function (key, value) {
              $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
            });

          } else {
            $("#city").empty();
          }
        }
      });
    } else {
      $("#city").empty();
    }
  });

  let placeOrder = document.getElementById('placeOrder');
  let loading = document.getElementById('loading');
  const form = document.getElementById('orderPlace');

  const handleSubmit = () => {
    loading.style.display = '',
      placeOrder.style.display = 'none',
      form.submit();
  } 
</script>
@endsection