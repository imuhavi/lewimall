<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
  <style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);

    .site-header {
      background-color: black;
      width: 100%;
      padding: 15px;
      color: white !important;
      text-align: center;
    }
  </style>
  <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
  <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
  <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
  <script src="https://kit.fontawesome.com/b868f71921.js" crossorigin="anonymous"></script>
</head>

<body>
  <header class="site-header" id="header">
    <h1 class="site_header__title" data-lead-id="site-header-title">Thank You!</h1>
  </header>
  <div class="main-content">
    <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
    <p class="main-content__body" data-lead-id="main-content-body">Congratulation! We are glad that you have
      subscription to 5dots. Your request under process please wait for activation.</p>
  </div>

  @if($shop && $shop->subscription)
  <div>
    <h4>Package Details:</h4>
    <p>Package Name: {{ $shop->subscription->name }} ({{ $shop->subscription->days
      }} Days)</p>
    <p>Expired: {{ date('d-M-Y', strtotime('+' . $shop->subscription->days . ' day',
      strtotime($shop->created_at ))) }}</p>
  </div>
  @endif

  <div>
    <h4>Contact Info: </h4>
    <p>Mobile Number: +966 53 458 8012</p>
    <p>Email: support@5dots.com</p>
  </div>

  <footer class="footer" id="footer">
    <p class="text-center">Copyright &copy;
      <script type="text/javascript"> document.write(new Date().getFullYear());</script> [5dots.sa] All
      rights reserved.
    </p>
  </footer>
</body>

</html>