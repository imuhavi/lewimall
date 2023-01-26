<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Title -->
  <title>5dots | Password Reset</title>

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

<body class="page-register">
  <main class="page-content">
    <div class="page-inner">
      <div id="main-wrapper">
        <div class="row">
          <div class="col-md-3 center">
            <div class="panel panel-white" id="js-alerts">
              <div class="panel-body">
                <div class="register-box">
                  <a href="index.html" class="logo-name text-lg text-center m-t-xs">
                    <img src="{{ asset('backend/assets/logo/logo.png') }}" alt="5dots-logo">
                  </a>
                  <p class="text-center m-t-md">Reset Your Passwrod.</p>
                  <form class="m-t-md" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                      <input type="text" class="form-control" name="email" placeholder="Email"
                        value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                        placeholder="Email" required>
                    </div>

                    <div class="form-group">
                      <input type="password" name="password_confirmation" class="password form-control"
                        placeholder="Confirm Password" required>
                    </div>


                    <button type="submit" class="btn btn-success btn-block m-t-xs">Reset Password</button>
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
  <script src="assets/plugins/jquery/jquery-3.1.0.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/plugins/pace-master/pace.min.js"></script>
  <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/plugins/switchery/switchery.min.js"></script>
  <script src="assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
  <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
  <script src="assets/plugins/waves/waves.min.js"></script>
  <script src="assets/js/meteor.min.js"></script>

</body>

</html>