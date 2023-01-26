<!DOCTYPE html>
<html lang="en">

@include('backend.body.header')
@include('backend.body.sidemenu')

{{-- Main Content --}}
@yield('content')

</main>
<!-- Page Content -->
<nav class="cd-nav-container" id="cd-nav">
  <header>
    <h3>DEMOS</h3>
  </header>
  <div class="col-md-6 demo-block demo-selected demo-active">
    <p>Dark<br>Design</p>
  </div>
  <div class="col-md-6 demo-block">
    <a href="../admin2/index.html">
      <p>Light<br>Design</p>
    </a>
  </div>
  <div class="col-md-6 demo-block">
    <a href="../admin3/index.html">
      <p>Material<br>Design</p>
    </a>
  </div>
  <div class="col-md-6 demo-block demo-coming-soon">
    <p>Horizontal<br>(Coming)</p>
  </div>
  <div class="col-md-6 demo-block demo-coming-soon">
    <p>Coming<br>Soon</p>
  </div>
  <div class="col-md-6 demo-block demo-coming-soon">
    <p>Coming<br>Soon</p>
  </div>
</nav>
<div class="cd-overlay"></div>

{{-- Preloder --}}
<!-- <div id="preloader">
  <div id="status"></div>
</div> -->



<!-- Javascripts -->
<script src="{{ asset('backend/') }}/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/pace-master/pace.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/switchery/switchery.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/offcanvasmenueffects/js/classie.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/waves/waves.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/3d-bold-navigation/js/main.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/curvedlines/curvedLines.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/chartjs/Chart.bundle.min.js"></script>

<script src="{{ asset('backend/') }}/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>

<script src="{{ asset('backend/') }}/assets/plugins/summernote-master/summernote.min.js"></script>
<script src="{{ asset('backend/') }}/assets/js/meteor.min.js"></script>
<script src="{{ asset('backend/') }}/assets/js/pages/dashboard.js"></script>
<script src="{{ asset('backend/') }}/assets/js/pages/table-data.js"></script>
<script src="{{ asset('backend/') }}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
  var successNotification = "{{ session('success') }}"
  var infoNotification = "{{ session('info') }}"
  var warningNotification = "{{ session('warning') }}"
  var errorNotification = "{{ session('error') }}"
</script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('backend/') }}/assets/js/custom.js"></script>

@yield('footer_js')
</body>

</html>