<!DOCTYPE html>
<html lang="en">


@include('frontend.body.header')

@yield('content')

@include('frontend.body.footer')


<!-- Bootstrap Js Link -->

<script type="text/javascript" src="{{ asset('/frontend/assets/') }}/js/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="{{ asset('/frontend/assets/') }}/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('backend/') }}/assets/plugins/toastr/toastr.min.js"></script>
<script>
  var successNotification = "{{ session('success') }}"
  var infoNotification = "{{ session('info') }}"
  var warningNotification = "{{ session('warning') }}"
  var errorNotification = "{{ session('error') }}"

  // CounterUp Plugin || Toastr
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: 'fadeIn',
      hideMethod: 'fadeOut',
      timeOut: 5000
    }
    if (successNotification) toastr.success(successNotification, 'Success !')
    if (infoNotification) toastr.info(infoNotification, 'Information !')
    if (warningNotification) toastr.warning(warningNotification, 'Warning !')
    if (errorNotification) toastr.error(errorNotification, 'Error !')
  }, 1800)
</script>

<!-- Price Range -->
@yield('footer_js')
@include('sweetalert::alert')

<!-- Select 2 -->
<script src="{{ asset('/frontend/assets/') }}/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Nice Select -->
<script src="{{ asset('/frontend/assets/') }}/js/jquery.nice-select.min.js"></script>

<!-- HS Menu -->
<script src="{{ asset('/frontend/assets/') }}/js/jquery.hsmenu.min.js"></script>
<!-- Owl carousel  -->
<script src="{{ asset('/frontend/assets/') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('/frontend/assets/') }}/js/wow.min.js"></script>
<!-- Slick Slider -->
<script src="{{ asset('/frontend/assets/') }}/js/slick.min.js"></script>
<!-- Custom Js Link -->
<script src="{{ asset('/frontend/assets/') }}/js/custome.js"></script>
</body>

</html>