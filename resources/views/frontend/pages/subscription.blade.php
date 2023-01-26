@extends('frontend.master')
@section('content')
<!-- Package Section Start -->
<section class="container py-5 position-relative" id="package">
  <div class="text-center mb-5">
    <h2 class=" section-title">Merchant Pricing</h2>
    <p>Dream big, start small, and connect the dots.</p>
  </div>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5 position-relative">
    @foreach($data as $item)
    <div class="col">
      <div class="card shadow">
        <div class="card-header text-center bg-dark p-2">
          <h3 class="text-white">{{ $item->name }}</h3>
        </div>
        <div class="card-body bg-light">
          <div class="package-price text-center mb-4">
            <h2 class="card-title">{{ $item->price }} Shillings</h2>
            <p><small>{{ ($item->days / 30) }} Month(s)</small></p>
          </div>
          <ul class="list-unstyled package-feature ">
            @foreach($item->subscriptionOptions as $item2)
            <li class="bg-white px-4 py-3 m-3 shadow-sm rounded-pill">
              <i class="fas fa-check-circle">
                {{ $item2->option }}
              </i>
            </li>
            @endforeach
          </ul>

        </div>
        <div class="card-footer text-center">
          <a href="{{ route('sellerRegister', $item->id) }}" class="btn btn-dark w-75 p-2">Get Started</a>
        </div>
      </div>
    </div>
    @endforeach
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
@endsection