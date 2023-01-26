@extends('frontend.master')
@section('content')
<section>
  <div class="row">
    <div class="col-md-4 offset-md-4 mt-5">
      <div class="modal-content">
        <div class="modal-header">
          <h3><span class="logo">Five Dots</span></h3>
          <p>We'll send you a link to reset your password.</p>
        </div>
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="modal-body forgetPassword-modal">
            <div class="row mt-3 g-3">

              <div class="col-12">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Your Email Address">
              </div>

              <div class="col-12">
                <button class="login-btn">Submit Email</button>
              </div>


              <div class="col-12 text-center">
                <p class="login_or">Or</p>
              </div>

              <div class="d-flex justify-content-center">
                <p>Back to <a href="{{ route('userLogin') }}" class="fs-6 fw-bold">Login</a>
                </p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection