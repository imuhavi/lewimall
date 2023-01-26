<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Withdraw Request</title>
  <style>
    .site-header {
      background-color: black;
      width: 100%;
      padding: 15px;
      color: white !important;
      text-align: center;
    }
  </style>
</head>

<body>
  <header class="site-header" id="header">
    <h1 class="site_header__title" data-lead-id="site-header-title">Update withdraw request!</h1>
  </header>

  <main>
    <h4>Your withdraw request is <i><b>{{ $withdraw->status }}</b></i></h4>
  </main>

  <footer class="footer" id="footer">
    <p class="text-center">Copyright &copy;
      <script type="text/javascript"> document.write(new Date().getFullYear());</script> [5dots.sa] All
      rights reserved.
    </p>
  </footer>

</body>

</html>