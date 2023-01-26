@extends('frontend.master')
@section('content')
<section>
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="modal-content mt-5">
        <div class="modal-header">
          <h3><span class="logo">Five Dots</span></h3>
          <p>By Register, you agree to our <a href="{{ route('termsAndCondition') }}">terms</a> & <a
              href="{{ route('privacyPolicy') }}">policy.</a></p>
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger">
            <ul>
              <li>{{ session('error') }}</li>
            </ul>
          </div>
          @endif
        </div>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="modal-body">
            <div class="row mt-3 g-3">
              <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Your Name" name="name"
                  value="{{ old('name') }}">
              </div>

              <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Your Email Address"
                  value="{{ old('email') }}">
              </div>

              <div class="col-12">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">05</div>
                  </div>
                  <input type="number" class="form-control" id="phone" name="phone" placeholder="Your Phone Number"
                    required value="{{ old('phone') }}">
                </div>
              </div>

              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                  required autocomplete="new-password" value="{{ old('password') }}">
              </div>

              <div class="col-12">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password"
                  name="password_confirmation" value="{{ old('password') }}">
              </div>

              <div class="col-12">
                <button type="submit" class="login-btn">Register</button>
              </div>

              <div class="col-12 text-center">
                <p class="login_or">Or</p>
              </div>

              <div class="col-12 login-with-google">
                <a class="google-login" href="{{ route('gmail') }}"><i class="fab fa-google"></i> Login With
                  Google</a>
              </div>

              <div class="d-flex justify-content-center">
                <p>Already have an account? <a href="{{ route('userLogin') }}" class="fs-6 fw-bold">Login</a></p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection