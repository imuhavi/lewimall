@extends('frontend.master')
@section('header_css')
<link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/jquery.nice-number.min.css">
@endsection
@section('content')
<main>
  <section id="wishlist">
    <div class="container my-3">
      <!-- Bradcum Here -->
      <nav aria-label="breadcrumb my-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
      </nav>

      <h3 class="wishlist-section-tile">Favorites list Item:</h3>

      <div class="row">
        <div class="col-md-12">
          <div class="cart_list">
            <div class="cart_item_details">
              <div class="check_box">
                <input type="checkbox">
              </div>
              <div class="cart_pro_img">
                <img src="{{ asset('frontend/assets/') }}/images/product-img-2.png" alt="product">
              </div>
              <div class="cart_pro_text">
                <p class="item_name">your product name here</p>
                <a href="#"><i class="far fa-trash-alt"></i></a>
                <a href="#"><i class="fa fa-heart-o"></i></a>
              </div>
              <div class="wishlist-action">
                <input type="number" placeholder="1" value="1" min="0">
                <h6>SA 906</h6>
                <a href="#" class="cart-btn">add to cart</a>
              </div>
            </div>
            <div class="cart_item_details">
              <div class="check_box">
                <input type="checkbox">
              </div>
              <div class="cart_pro_img">
                <img src="{{ asset('frontend/assets/') }}/images/product-img-2.png" alt="product">
              </div>
              <div class="cart_pro_text">
                <p class="item_name">your product name here</p>
                <a href="#"><i class="far fa-trash-alt"></i></a>
                <a href="#"><i class="fa fa-heart-o"></i></a>
              </div>
              <div class="wishlist-action">
                <input type="number" placeholder="1" value="1" min="0">
                <h6>SA 906</h6>
                <a href="#" class="cart-btn">add to cart</a>
              </div>
              <div class="cart_text"></div>
            </div>
            <div class="cart_item_details">
              <div class="check_box">
                <input type="checkbox">
              </div>
              <div class="cart_pro_img">
                <img src="{{ asset('frontend/assets/') }}/images/product-img-3.png" alt="product">
              </div>
              <div class="cart_pro_text">
                <p class="item_name">your product name here</p>
                <a href="#"><i class="far fa-trash-alt"></i></a>
                <a href="#"><i class="fa fa-heart-o"></i></a>
              </div>
              <div class="wishlist-action">
                <input type="number" placeholder="1" value="1" min="0">
                <h6>SA 906</h6>
                <a href="#" class="cart-btn">add to cart</a>
              </div>
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