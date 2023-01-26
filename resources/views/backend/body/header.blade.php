<head>

  <!-- Title -->
  <title>{{ str_replace('-', ' ',
    config('app.name')) }} | {{ ucfirst(routePrefix()) }} - @yield('meta_title', 'Dashboard') </title>

  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="UTF-8">
  <meta name="description" content="@yield('meta_description', 'Welcome to our admin panel')" />
  <meta name="keywords" content="admin,dashboard" />
  <meta name="author" content="stacks" />

  <!-- Styles -->
  <link href="{{ asset('backend/') }}/assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
  <link href="{{ asset('backend/') }}/assets/plugins/uniform/css/default.css" rel="stylesheet" />
  <link href="{{ asset('backend/') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
  <link href="{{ asset('backend/') }}/assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/slidepushmenus/css/component.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

  <link href="{{ asset('backend/') }}/assets/plugins/summernote-master/summernote.css" rel="stylesheet"
    type="text/css" />

  <link href="{{ asset('backend/') }}/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"
    type="text/css" />

  <!-- Theme Styles -->
  <link href="{{ asset('backend/') }}/assets/css/meteor.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/') }}/assets/css/layers/dark-layer.css" class="theme-color" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend/') }}/assets/css/custom.css" rel="stylesheet" type="text/css" />

  <script src="{{ asset('backend/') }}/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



</head>

<body class="compact-menu">

  <div class="overlay"></div>

  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
    <h3><span class="pull-left">Michael Lewis</span> <a href="javascript:void(0);" class="pull-right"
        id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
    <div class="slimscroll chat">
      <div class="chat-item chat-item-left">
        <div class="chat-image">
          <img src="{{ asset('backend/assets/images/avatar2.png') }}" alt="">
        </div>
        <div class="chat-message">
          Duis aute irure dolor?
        </div>
      </div>
      <div class="chat-item chat-item-right">
        <div class="chat-message">
          Lorem ipsum dolor sit amet, dapibus quis, laoreet et.
        </div>
      </div>
      <div class="chat-item chat-item-left">
        <div class="chat-image">
          <img src="{{ asset('backend/assets/images/avatar2.png') }}" alt="">
        </div>
        <div class="chat-message">
          Ut ullamcorper, ligula.
        </div>
      </div>
      <div class="chat-item chat-item-right">
        <div class="chat-message">
          In hac habitasse platea dict umst. ligula eu tempor eu id tincidunt.
        </div>
      </div>
      <div class="chat-item chat-item-left">
        <div class="chat-image">
          <img src="{{ asset('backend/assets/images/avatar2.png') }}" alt="">
        </div>
        <div class="chat-message">
          Curabitur pretium?
        </div>
      </div>
      <div class="chat-item chat-item-right">
        <div class="chat-message">
          Etiam tempor. Ut tempor! ull amcorper.
        </div>
      </div>
    </div>
    <div class="chat-write">
      <form class="form-horizontal" action="javascript:void(0);">
        <input type="text" class="form-control" placeholder="Say something">
      </form>
    </div>
  </nav>
  <form class="search-form" action="#" method="GET">
    <div class="input-group">
      <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
      <span class="input-group-btn">
        <button class="btn btn-default close-search" type="button"><i class="icon-close"></i></button>
      </span>
    </div><!-- Input Group -->
  </form><!-- Search Form -->

  <main class="page-content content-wrap">
    <div class="navbar">
      <div class="navbar-inner">
        <div class="sidebar-pusher">
          <a href="javascript:void(0);" class="waves-effect waves-button push-sidebar">
            <i class="icon-arrow-right"></i>
          </a>
        </div>
        <div class="logo-box">
          <a href="{{ route('home') }}" target="_blank" class=" logo-text"><span>{{ str_replace('-', ' ',
              config('app.name')) }}</span></a>
        </div><!-- Logo Box -->
        <div class="search-button">
          <a href="javascript:void(0);" class="show-search"><i class="icon-magnifier"></i></a>
        </div>
        <div class="topmenu-outer">
          <div class="top-menu">
            <ul class="nav navbar-nav navbar-left">
              <li>
                <a href="javascript:void(0);" class="sidebar-toggle"><i class="icon-arrow-left"></i></a>
              </li>


              {{-- <li>
                <a href="#cd-nav" class="cd-nav-trigger"><i class="icon-support"></i></a>
              </li> --}}

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                  <li class="li-group">
                    <ul class="list-unstyled">
                      <li class="no-link" role="presentation">
                        Fixed Header
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right fixed-header-check">
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="li-group">
                    <ul class="list-unstyled">
                      <li class="no-link" role="presentation">
                        Fixed Sidebar
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                        </div>
                      </li>
                      <li class="no-link" role="presentation">
                        Horizontal bar
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right horizontal-bar-check">
                        </div>
                      </li>
                      <li class="no-link" role="presentation">
                        Toggle Sidebar
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                        </div>
                      </li>
                      <li class="no-link" role="presentation">
                        Compact Menu
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right compact-menu-check" checked>
                        </div>
                      </li>
                      <li class="no-link" role="presentation">
                        Hover Menu
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right hover-menu-check">
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="li-group">
                    <ul class="list-unstyled">
                      <li class="no-link" role="presentation">
                        Boxed Layout
                        <div class="ios-switch pull-right switch-md">
                          <input type="checkbox" class="js-switch pull-right boxed-layout-check">
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="no-link"><button class="btn btn-default reset-options">Reset
                      Options</button></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

              @if(routePrefix() === 'admin')
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope-open"></i><span
                    class="badge badge-danger pull-right">0</span></a>
                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                  <li>
                    <p class="drop-title">You have 0 new messages!</p>
                  </li>
                  <li class="dropdown-menu-list slimscroll messages">
                    <ul class="list-unstyled">
                      <li>
                        <a href="#">
                          <p class="msg-name">No Message Avaiable</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bell"></i><span
                    class="badge badge-danger pull-right">{{ count(auth()->user()->unreadNotifications)
                    }}</span></a>
                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                  <li>
                    <p class="drop-title">Latest Notification!</p>
                  </li>
                  <li class="dropdown-menu-list slimscroll tasks">
                    <ul class="list-unstyled">

                      @foreach(auth()->user()->unreadNotifications->take(5) as $notification )
                      <li>
                        <a href="{{ route('markAsRead', $notification->id) }}">
                          <div class="task-icon badge badge-danger"><i class="icon-bell"></i></div>
                          @switch($notification)
                          @case($notification->type == 'App\Notifications\NotifySellerRegister')
                          <span class="badge badge-roundless badge-default pull-right">

                            {{
                            $notification->created_at->shortRelativeDiffForHumans() }}</span>
                          <p class="task-details">Seller Registed!</p>
                          @break
                          @case($notification->type == 'App\Notifications\NotifyCreateProduct')
                          <span class="badge badge-roundless badge-default pull-right">
                            {{
                            $notification->created_at->shortRelativeDiffForHumans() }}</span>
                          <p class="task-details">Product Created!</p>
                          @break

                          @case($notification->type == 'App\Notifications\NotifyOrderPlaced')
                          <span class="badge badge-roundless badge-default pull-right">
                            {{
                            $notification->created_at->shortRelativeDiffForHumans() }}</span>
                          <p class="task-details">Get New Order!</p>
                          @break
                          @endswitch
                        </a>
                      </li>
                      @endforeach

                    </ul>
                  </li>

                </ul>
              </li>
              @endif
              @if(routePrefix() === 'seller')
              <li>
                <h3 style="color: white; margin-top: 17px;">{{ Auth::user()->balance }} SR</h3>
              </li>
              @endif
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="user-name">{{ Auth::user()->name ?? "" }}<i class="fa fa-angle-down"></i></span>
                  @if(auth()->user()->avatar)
                  <img class="img-circle avatar" src="{{ asset('backend/uploads/' . auth()->user()->avatar) }}"
                    width="40" height="40" alt="">
                  @else
                  <img class="img-circle avatar" src="{{ asset('backend/assets/default-img/user.jpeg') }}" width="40"
                    height="40" alt="">
                  @endif
                </a>
                <ul class="dropdown-menu dropdown-list" role="menu">
                  <li role="presentation"><a href="{{ route('userProfile') }}"><i class="icon-user"></i>Profile</a>
                  </li>

                  <li role="presentation" class="divider"></li>

                  <li role="presentation"><a href="#" onclick="logout()"><i class="icon-key m-r-xs"></i>Log out</a></li>
                </ul>

                <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                  @csrf
                </form>

              </li>


            </ul><!-- Nav -->
          </div><!-- Top Menu -->
        </div>
      </div>
    </div><!-- Navbar -->

    <script>
      // Logout
      let logoutForm = document.getElementById('logoutForm')
      function logout() {
        event.preventDefault()
        if (confirm('Are you sure to logout ?')) logoutForm.submit()
      }
    </script>