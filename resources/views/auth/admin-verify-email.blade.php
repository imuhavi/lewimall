<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Title -->
  <title>5dots | Verify-Email</title>

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
                  <p class="text-center m-t-md text-warning">Thanks for Registraion! Before Log in your account, Plsease
                    verify your
                    email address by clicking
                    on the
                    link we just emailed to you! If you didn't receive the email, we will gladly send you another.
                  </p>

                  @if (session('status') == 'verification-link-sent')
                  <div class="text-center m-t-md text-info">
                    {{ __('A new verification link has been sent to the email address you provided during
                    registration.') }}
                  </div>
                  @endif

                  <div>
                    <form method="POST" action="{{ route('verification.send') }}">
                      @csrf
                      <button class="btn btn-default btn-block m-t-md">Resend Verification
                        Email</button>
                    </form>
                  </div>


                  <div class="m-t-xs">
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <button type="submit" class="btn btn-danger btn-block">Logout</button>

                    </form>
                  </div>
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