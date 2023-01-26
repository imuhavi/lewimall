@extends('frontend.master')
@section('content')
<main>
  <section>
    <div class="row">
      <div class="col-md-4 col-12 offset-md-4">
        <div class="modal-content mt-5">
          <div class="modal-header">
            <h3><span class="logo">Five Dots</span></h3>
            <p>Login with your email & password.</p>

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

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="modal-body">
              <div class="row mt-3 g-3">
                <div class="col-12">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" placeholder="Your Email Address" name="email"
                    value="{{ old('email') }}">
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputAddress" placeholder="Password" name="password"
                    value="{{ old('password') }}">
                </div>

                <div class="col-12 d-flex justify-content-between">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Remember Me
                    </label>
                  </div>
                  <a href="{{ route('forgotPassword') }}" class="fs-6 fw-bold">Forget
                    Password?</a>
                </div>

                <div class="col-12">
                  <button type="submit" class="login-btn">Log In</button>
                </div>
          </form>

          <div class="col-12 text-center">
            <p class="login_or">Or</p>
          </div>

          <div class="col-12 login-with-google">
            <a class="google-login" href="{{ route('gmail') }}"><i class="fab fa-google"></i> Login With Google</a>
          </div>

          <div class="d-flex justify-content-center">
            <p>Don't have any account? <a href="{{ route('userRegister') }}" class="fs-6 fw-bold">Register</a></p>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection