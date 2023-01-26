@extends('frontend.master')
@section('content')
<main>

  <!---------------------------
            Slider Start Here 
      ----------------------------->
  <section id="showcase" class="bg-dark">
    @if(count($slider))
    <div id="myCarousel" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        @foreach($slider as $key => $citem)
        <li data-bs-slide-to="{{ $key }}" data-bs-target="#myCarousel" class="{{$key == 0 ? 'active' : '' }}">
        </li>
        @endforeach
      </ol>
      <div class="carousel-inner">

        @foreach($slider as $key => $item)

        @if($item->category)

        <div style="background-image: url({{asset('backend/uploads/'. $item->banner)}})"
          class="carousel-item carousel-img {{$key == 0 ? 'active' : '' }}" data-bs-interval="3000">
          <div class="container">
            <div class="carousel-caption text-dark text-left">
              <div class="carousel-text">
                <p class="wow bounceInDown" data-wow-duration="1s" data-wow-delay="0s">{{ $item->sub_title }}</p>

                <h1 class=" wow bounceInDown" data-wow-duration="1.2s" data-wow-delay=".2s">{{ $item->title }}</h1>
                <a class="btn fivedots-btn wow bounceInDown" data-wow-duration="1.5s" data-wow-delay=".5s"
                  href="{{ route('categoryShop', ['id'=> $item->category->id, 'slug' => $item->category->slug]) }}">Shop
                  Now <img class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow-light.png" alt=""></a>
              </div>
            </div>
          </div>
        </div>

        @endif

        @endforeach
      </div>
      <a href="#myCarousel" class="carousel-control-prev" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a href="#myCarousel" class="carousel-control-next" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
    @else
    <h2 class="text-white text-center p-3"> No Slider Available !</h2>
    @endif
  </section>

  <!---------------------------
            Womans Category Start 
      ----------------------------->
  <section id="womens-category">
    <div class="container">
      <div class="row">
        <div class="col-md-3 child-category">
          @foreach($womensSub1 as $item)
          <div class="child-cat-item ">
            <a href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}"><img class="w-100"
                src="{{ asset('/backend/uploads/'. $item->icon) }}" alt="womens-{{ $item->icon }}"></a>
            <h3>{{ $item->name }}</h3>
            <a class="explore-btn"
              href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}">Explore
              <img class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow.png" alt=""></a>
          </div>
          @endforeach
        </div>
        @if($womensMain)
        <div class="col-md-6 category-main">
          <div class="parent-cat-item">
            <div class="overflow"></div>
            <img class="img-fluid" src="{{ asset('/backend/uploads/'. $womensMain->banner) }}" alt="women's Main">
            <div class="parent-cat-content">
              <h4>{{ $womensMain->name }}</h4>
              <h2>{{ __('NEW FASHION COLLECTION') }}</h2>
              <p>From only SA 100.00</p>

              <a class="fivedots-btn mt-4"
                href="{{ route('categoryShop', ['id'=> $womensMain->id, 'slug' => $womensMain->slug]) }}">Shop Now <img
                  class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow-light.png" alt=""></a>
            </div>
          </div>
        </div>
        @else
        <h2>No Womens Category Available!</h2>
        @endif

        <div class="col-md-3 child-category">
          @foreach($womensSub2 as $item)
          <div class="child-cat-item">
            <a href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}"><img class="w-100"
                src="{{ asset('/backend/uploads/'. $item->icon) }}" alt="womans-{{ $item->icon }}"></a>
            <h3>{{ $item->name }}</h3>
            <a class="explore-btn"
              href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}">Explore
              <img class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow.png" alt=""></a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!---------------------------
          Banner Section One 
      ----------------------------->
  <section id="banner-one">
    <div class="conteiner">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="banner-content">
            <h5 class="banner-sub-heading">{{ $bannerOne->category->name ?? '' }}</h5>
            <h3 class="banner-heading">{{ $bannerOne->title ?? '' }}</h3>
            <a class="fivedots-btn" href="">Shop
              Now <img class="icon" src="{{ asset('/backend/uploads'. $bannerOne->banner) }}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!---------------------------
          Mens Category Start 
      ----------------------------->
  <section id="mens-category" class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="row gy-5">
          @foreach($mensSub as $item)
          <div class="col-md-6">
            <div class="child-cat-item">
              <a href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}"><img class="img-fluid"
                  src="{{ asset('/backend/uploads/'. $item->icon) }}" alt="women's-1"></a>
              <h3>{{ $item->name }}</h3>
              <a class="explore-btn"
                href="{{ route('subCategoryShop', ['id'=> $item->id, 'slug' => $item->slug]) }}">Explore <img
                  class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow.png" alt=""></a>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="col-md-6 category-main">
        @if($mensMain)
        <div class="parent-cat-item">
          <div class="overflow"></div>
          <img class="img-fluid parent-cat-banner" src="{{ asset('/backend/uploads/'. $mensMain->banner) }}"
            alt="women's Main">
          <div class="parent-cat-content">
            <h4>Weekend Sale</h4>
            <h2>New Fashion Collection</h2>
            <p>From only SA 180.00</p>
            <a class="fivedots-btn mt-4"
              href="{{ route('categoryShop', ['id'=> $mensMain->id, 'slug' => $mensMain->slug]) }}">Shop Now <img
                class="icon" src="{{ asset('frontend/assets') }}/images/btn-arrow-light.png" alt=""></a>
          </div>
        </div>
        @endif
      </div>

    </div>
  </section>

  <!---------------------------
                Banner Two 
      ---------------------------->
  <section id="banner-two">
    <div class="conteiner">
      <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
          <div class="banner-content bc-two">
            <h3 class="banner-heading">{{ $bannerTwo->title ?? '' }}</h3>
            <a class="fivedots-btn" href="">Shop
              Now <img class="icon" src="{{ asset('backend/uploads', $bannerOne->banner ?? '') }}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!---------------------------------
            Product BY Category one 
      ---------------------------------->
  <section id="product-category-men">
    <div class="container">
      <h2 class="section-title text-center text-white mb-md-4">Our Latest Product</h2>
      <div id="product" class="owl-carousel">

        @foreach($products as $product)

        @php
        $discountAmount = ($product->price - ($product->discount / 100) * $product->price);
        $discount = (($product->discount * 100) / $product->price)
        @endphp

        <div class="item">
          <div class="product-item">
            <a class="w-100" href="{{ route('productView', $product->slug) }}"><img class="img-fluid"
                src="{{ asset('backend/uploads/' . $product->thumbnail) }}" alt="product-img-1"></a>

            <div class="product-content">
              <a href="{{ route('productView', $product->slug) }}" class="product-title-home">{{
                Str::limit($product->name,
                25) }}</a>
              @if($product->discount == null )
              <div class="d-flex justify-content-between align-items-center">
                <h3 class="new-price my-3">SA <span> {{ $product->price }}</span></h3>
                <span class="wishlist"><i class="far fa-heart"></i></span>
              </div>
              @endif
              @if($product->discount !== null && $product->discount_type == 'Flat')
              <h3 class="new-price my-3">SA <span>{{ $product->price- $product->discount }}</span></h3>

              <div class="d-flex justify-content-between">
                <div class="off">
                  <span class="old-price">{{ $product->price }}</span>
                  <span class="discount">{{ round($discount) }}% OFF</span>
                </div>
                <span class="wishlist"><i class="far fa-heart"></i></span>
              </div>
              @endif
              @if($product->discount !== null && $product->discount_type == 'Percent')
              <h3 class="new-price my-3">SA <span>{{ $product->price- $product->discount }}</span></h3>
              <div class="d-flex justify-content-between">
                <div class="off">
                  <span class="old-price">{{ $product->price }}</span>
                  <span class="discount">{{ round($product->discount)}}% OFF</span>
                </div>
                <span class="wishlist"><i class="far fa-heart"></i></span>
              </div>
              @endif
              @if($product->discount !== null && $product->discount_type !== 'Percent' && $product->discount_type !==
              'Flat')
              <h3 class="new-price my-3">SA <span>{{ $product->price- $product->discount }}</span></h3>
              <div class="d-flex justify-content-between">
                <div class="off">
                  <span class="old-price">{{ $product->price }}</span>
                  <span class="discount">{{ round($discount) }}% OFF</span>
                </div>
                <span class="wishlist"><i class="far fa-heart"></i></span>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endforeach

      </div>

      <div class="text-center mt-4">
        <a class="fivedots-btn" href="{{ route('shop') }}">View More <img class="icon"
            src="{{ asset('frontend/assets') }}/images/btn-arrow-light.png" alt=""></a>
      </div>
    </div>
  </section>

  <!--------------------------------
            Banner Section Three
      --------------------------------->
  <section id="banner-three">
    <div class="conteiner">
      <div class="row">
        <div class="col-6">
          <div class="banner-content">
            <h3 class="banner-heading">{{ $bannerThree->category->name ?? '' }} <span class="d-block">{{
                $bannerThree->title ?? ''
                }}</span></h3>
            <a class="fivedots-btn" href="">Shop
              Now <img class="icon" src="{{ asset('backend/uploads', $bannerThree->banner ?? '') }}" alt=""></a>
          </div>
        </div>
        <div class="col-6">
        </div>
      </div>
    </div>
  </section>

  <!-------------------------------
            Product BY Brand
      -------------------------------->
  <section id="product-category-men">
    <div class="container">
      <div class="row">
        <h2 class="section-title text-center text-white mb-3">Shop By Brand</h2>
        <div class="col-md-12">
          <div id="brand" class="owl-carousel">
            @foreach( $shops as $shop)
            <div class="items"><a href="#"><img src="{{ asset('backend/uploads/'. $shop->shop_logo) }}" alt=""></a>
            </div>
            @endforeach
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
        <div class="col-md-10 offset-md-1 col-12">
          <div class="row align-items-center">
            <div class="col-md-7">
              <div class="subscribe-content">
                <h2>Get your update news</h2>
                <p>We connect the dots.</p>
              </div>
            </div>
            <div class="col-md-5">
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