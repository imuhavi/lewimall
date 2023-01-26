<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ str_replace('-', ' ',
    config('app.name')) }}</title>
  {{-- Ajax Request Meta --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://kit.fontawesome.com/b868f71921.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/assets/') }}/css/bootstrap.min.css">
  @yield('header_css')
  <link rel="stylesheet" href="{{ asset('/frontend/assets/') }}/css/select2.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets/') }}/css/nice-select.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets/') }}/css/jquery.nice-number.min.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/slick.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/hs-menu.min.css" />
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/animate.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/material-design/css/material-design-iconic-font.css" />
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/carousel.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/custom.css">
  <link rel="stylesheet" href="{{ asset('/frontend/assets') }}/css/responsive.css">
  <link href="{{ asset('backend/') }}/assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
  <style>
    .cartParent {
      position: relative;
    }

    .totalCart {
      position: absolute;
      background: black;
      width: 20px;
      height: 20px;
      line-height: 20px;
      color: white;
      text-align: center;
      border-radius: 50%;
      font-size: 12px;
      top: -12px;
      left: 20px;
    }
  </style>
</head>

<body>

  @php
  $categories = getCategories()
  @endphp


  <header>

    <!---------------------------
          Navbar Top Start 
  ---------------------------->

    <div class="nav-top">
      <div class="container py-2">
        <div class="d-flex justify-content-around align-items-center">
          <div class="col-md-4 d-flex  justify-content-start">
            <form action="" class="search-box-desk d-flex align-items-center py-1 order-sm-1 order-1 order-lg-0">
              <div class="search-icon">
                <img class="img-fluid" src="{{ asset('frontend/assets') }}/images/search-normal.png" alt="search-icon">
              </div>
              <input class="search border-0 p-2 ms-1" type="search" id="" placeholder="Search items...">
            </form>
          </div>
          <div class="col-md-4 d-flex justify-content-center">
            <a class="navbar-brand" href="{{ route('home') }}"><span class="logo">Lewi
                Mall</span></a>
          </div>
          <div class="col-md-4 d-flex  justify-content-end">
            <ul class="top-bar-right d-flex">
              <li>
                @auth
                <a href="#" class="signIn" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><img
                    src="{{ asset('frontend/assets') }}/images/profile.png" alt="user-profile"></a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item"
                      href="@if(auth()->user()->role == 'Customer') {{ url(routePrefix(). '/orders') }} @else {{ url(routePrefix(). '/dashboard') }} @endif">{{
                      Str::words(Auth::user()->name) }}</a>
                  </li>
                  <li><a class="dropdown-item" href="#" onclick="logout()">Log out</a></li>
                </ul>
                <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                  @csrf
                </form>

                @else
                <a href="{{ route('userLogin') }}" class="signIn"><img
                    src="{{ asset('frontend/assets') }}/images/profile.png" alt="user-profile"></a>
                @endauth
              </li>

              <li><a href="#"><img src="{{ asset('frontend/assets') }}/images/heart.png" alt="user-profile"></a></li>


              <li class="cartParent"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                  aria-controls="offcanvasRight"><img src="{{ asset('frontend/assets') }}/images/shopping-cart.png"
                    alt="user-profile"></a>
                @php
                $cart = getCart()
                @endphp
                <div class="totalCart" id="numberOfItem">{{ count($cart['cart']) }}</div>
              </li>

            </ul>
          </div>

        </div>
      </div>
    </div>

    <!--------------------------
          Navbar Mega  Menu
    ---------------------------->
    <nav class="navbar navbar-expand-lg bg-light menu">

      <div class="container px-0">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="fa fa-home"></i> {{
                __('Home') }}</a>
            </li>
          </ul>
        </div>

        <div class="collapse navbar-collapse mobile-menu" id="navbarNavDropdown">
          <ul class="main_menu navbar-nav m-auto">
            @foreach($categories as $category)
            <li class="static"><a href="#">{{
                $category->name }} <i class="fas fa-angle-down"></i></a>
              <div class="mega_full">
                <div class="row">
                  @foreach($category->subcategory as $subcategory)
                  <div class="col-lg-2">
                    <ul class="mega_item">
                      <li><a
                          href="{{ route('subCategoryShop', ['id'=> $subcategory->id, 'slug' => $subcategory->slug]) }}">{{
                          $subcategory->name }}</a></li>
                    </ul>
                  </div>
                  @endforeach
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="collapse navbar-collapse">
          <div class="nav-item dropdown d-none d-sm-none d-md-none d-lg-block ms-auto">
            <a class="nav-link dropdown-toggle" href="#" id="language" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Language
            </a>
            <ul class="dropdown-menu" aria-labelledby="language">
              <li><a class="dropdown-item" href="#">Arabic</a></li>
              <li><a class="dropdown-item" href="#">English</a></li>
            </ul>
          </div>
        </div>
      </div>

    </nav>

    <!---------------------------
        Cart Item Off canvas
    ---------------------------->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"></div>

    <!----------------------
              Mobile Menu 
      ----------------------->
    <div class="menu-trigger hs-menubar"> <i class="fas fa-bars"></i></div>

    <nav class="hs-navigation">
      <ul class="nav-links">

        @foreach($categories as $category)
        <li class="has-child">
          <span class="its-parent">
            <span class="icon"></span> {{ $category->name }} <i class="fas fa-angle-down"></i></span>
          <ul class="its-children">
            <li class="has-child">
              @foreach($category->subcategory as $subcategory)
              <a href="#"> {{ $subcategory->name }} </a>
              @endforeach
            </li>
          </ul>
        </li>
        @endforeach
      </ul>
    </nav>
  </header>

  <script>
    let logoutForm = document.getElementById('logoutForm')
    function logout() {
      event.preventDefault()
      if (confirm('Are you sure to logout ?')) logoutForm.submit()
    }

    let totalCart = document.getElementById('numberOfItem');
    function getTotalCart() {
      $.ajax({
        url: '/gettotal-cart',
        dataType: 'json',
        success: function (response) {
          $('#numberOfItem').text(response)
        }
      })
    }
    onload = () => getTotalCart()

    let cartWrapper = document.getElementById('offcanvasRight')
    function getCart() {
      fetch('/get-cart')
        .then(response => response.text())
        .then(data => cartWrapper.innerHTML = data)
        .catch(error => console.log(error))
    }
    onload = () => getCart()


    function removeCart(key) {
      fetch(`/remove-cart/${key}`)
        .then(response => response.json())
        .then(data => {
          getTotalCart()
          console.log(data)
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            showConfirmButton: false,
            timer: 2000
          })
          if ($.isEmptyObject(data.error)) {
            Toast.fire({
              type: 'success',
              title: data,
            })
          }
          getCart()
        })
        .catch(error => console.log(error))
    }
  </script>