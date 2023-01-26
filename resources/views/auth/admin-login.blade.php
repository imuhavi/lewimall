<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Title -->
  <title>5dots | login</title>

  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="UTF-8">
  <meta name="description" content="Admin Dashboard Template" />
  <meta name="keywords" content="admin,dashboard" />
  <meta name="author" content="stacks" />

  <!-- Styles -->
  <link href="{{ asset('backend') }}/assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
  <link href="{{ asset('backend') }}/assets/plugins/uniform/css/default.css" rel="stylesheet" />
  <link href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend') }}/assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet"
    type="text/css" />

  <!-- Theme Styles -->
  <link href="{{ asset('backend') }}/assets/css/meteor.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend') }}/assets/css/layers/dark-layer.css" class="theme-color" rel="stylesheet"
    type="text/css" />
  <link href="{{ asset('backend') }}/assets/css/custom.css" rel="stylesheet" type="text/css" />

  <script src="{{ asset('backend') }}/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

</head>

<body class="page-login">
  <main class="page-content">
    <div class="page-inner">
      <div id="main-wrapper">
        <div class="row">
          <div class="col-md-3 center">
            <div class="panel panel-white" id="js-alerts">
              <div class="panel-body">
                <div class="login-box">
                  <a href="{{ route('home') }}" class="logo-name text-lg text-center m-t-xs">
                    <img src="{{ asset('backend/assets/logo/logo.png') }}" alt="5dots-logo">
                  </a>
                  <p class="text-center m-t-md">Please login into your account.</p>
                  <form method="POST" class="m-t-md" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Email">
                    </div>

                    <div class="form-group">
                      <input type="password" name="password" class="form-control password" placeholder="Password"
                        value="{{ old('password') }}">
                    </div>
                    <button type=" submit" class="btn btn-success btn-block">Login</button>
                    <a href="{{ route('password.email') }}" class="display-block text-center m-t-md text-sm">Forgot
                      Password?</a>
                    <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                    <a href="{{ route('register') }}" class="btn btn-default btn-block m-t-md">Create an account</a>
                  </form>
                  <p class="text-center m-t-xs text-sm">2022 &copy; 5dots</p>
                </div>
              </div>
            </div>
          </div>
        </div><!-- Row -->
      </div><!-- Main Wrapper -->
    </div><!-- Page Inner -->
  </main><!-- Page Content -->


  <!-- Javascripts -->
  <script src="{{ asset('backend') }}/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/pace-master/pace.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/switchery/switchery.min.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/offcanvasmenueffects/js/classie.js"></script>
  <script src="{{ asset('backend') }}/assets/plugins/waves/waves.min.js"></script>
  <script src="{{ asset('backend') }}/assets/js/meteor.min.js"></script>
</body>

</html>