@extends('backend.master')

@section('meta_title')
{{ Str::title(auth()->user()->name) }}
@endsection

@section('meta_description')
{{ Str::limit(auth()->user()->address) }}
@endsection

@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url( routePrefix() . '/dashboard') }}">Dashboard</a></li>
        <li><a href="#">User</a></li>
        <li class="active">User-Profile</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <h4 class="panel-title">Manage Profile Information</h4>
          </div>
          <div class="panel-body">
            <div class="card mb-4">
              <form action="{{ route('updateSeller') }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="card-body">
                  <input type="hidden" name="id" value="{{ $user->id }}">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Profile Photo</p>
                    </div>
                    <div class="col-sm-5">
                      <input type="file" accept="image/*" onchange="previewImage('avatar_preview', this.files)"
                        name="profile_photo" id="profile_photo" class="form-control">
                    </div>
                    <div class="col-sm-4">
                      @if(auth()->user()->avatar)
                      <img class="img avatar" id="avatar_preview"
                        src="{{ asset('backend/uploads/' . auth()->user()->avatar) }}" alt="" width="80px"
                        height="80px">
                      @else
                      <img class="img avatar" id="avatar_preview"
                        src="{{ asset('backend/assets/default-img/user.jpeg') }}" alt="" width="80px" height="80px">
                      @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="full_name" value="{{ $user->name }}" id="full_name" class="form-control">
                      @error('full_name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="email" title="You can not update your verified email" disabled
                        value="{{ $user->email }}" id="email" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="tel" name="phone" value="{{ $user->phone }}" id="phone" class="form-control">
                      @error('phone')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                      <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
                      @error('address')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="row" style="margin-top: 20px">
                    <div class="col-sm-12 text-right ">
                      <button class="btn btn-info" type="submit">Save Change</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="col-md-4">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <h4 class="panel-title">Change Password</h4>
          </div>
          <div class="panel-body">
            <form action="{{ route('updatePassword') }}" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group">
                  <label for="current_password">Current Passord</label>
                  <input type="password" name="current_password" class="form-control m-t-xxs" id="current_password"
                    placeholder="Current Password">
                  @error('current_password')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="password">New Passord</label>
                  <input type="password" name="password" class="form-control m-t-xxs" id="password"
                    placeholder="Current Password">
                  @error('password')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="conformation_password">Confirm Passord</label>
                  <input type="password" class="form-control m-t-xxs" name="password_confirmation"
                    id="conformation_password" placeholder="Confirm Password">
                </div>
              </div>

              <div class="row" style="margin-top: 20px">
                <div class="col-sm-12 text-right ">
                  <button class="btn btn-info" type="submit">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> -->
    </div>

    @if ( auth()->user()->role === 'Admin')
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <h4 class="panel-title">Manage Shop Information</h4>
          </div>
          <div class="panel-body">
            <div class="card mb-4">
              <form action="{{ route('updateShop') }}" method="post" enctype="multipart/form-data">
                @csrf
                @php
                $seller = $user;
                @endphp
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Package Name:</p>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" value="{{ $seller->shop->subscription->name }} ({{ $seller->shop->subscription->days
                                      }} Days)" readonly>
                    </div>

                    <div class="col-sm-3">
                      <p class="mb-0">Package Expired:</p>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime('+' . $seller->shop->subscription->days . ' day',
                                          strtotime($seller->shop->created_at ))) }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Shop Logo</p>
                    </div>
                    <div class="col-sm-5">
                      <input type="file" accept="image/*" onchange="previewImage('shop_logo_preview', this.files)"
                        name="shop_logo" id="shop_logo" class="form-control">
                    </div>
                    <div class="col-sm-4">
                      @if($seller->shop->shop_logo)
                      <img class="img avatar" id="shop_logo_preview"
                        src="{{ asset('backend/uploads/' . $seller->shop->shop_logo) }}"
                        alt="Shop-{{ $seller->shop_logo }}" width="80px" height="80px">
                      @else
                      <img class="img avatar" id="shop_logo_preview"
                        src="{{ asset('backend/assets/default-img/noimage.jpg') }}" alt="shop default logo" width="80px"
                        height="80px">
                      @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Shop Name</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="shop_name" value="{{ $seller->shop->shop_name }}" id="shop_name"
                        class="form-control">
                      @error('shop_name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Shop Created</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" readonly value="{{ $seller->shop->created_at->diffForHumans() }}"
                        id="shop_name" class="form-control">
                      @error('shop_name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Shop Address</p>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="shop_location" value="{{ $seller->shop->address }}" id="shop_location"
                        class="form-control">
                      @error('shop_location')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-sm-2">
                      <select id="state" name="state" class="form-control state">
                        <option selected hidden disabled value="">Choose State</option>
                        @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ $seller->shop->state_id == $state->id ?
                          'selected'
                          : '' }}>{{ $state->name }}
                        </option>
                        @endforeach
                      </select>
                      @error('shop_address')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-lg-2 col-md-2">
                      <select name="city" id="city" class="form-control city">
                        <option selected hidden disabled value="">Choose City</option>
                      </select>
                    </div>

                    <div class="col-sm-2">
                      <input type="text" name="shop_location" value="{{ $seller->shop->postal_code }}"
                        id="shop_location" class="form-control">
                      @error('shop_location')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>

                  <div class="row" style="margin-top: 20px">
                    <div class="col-sm-12 text-right ">
                      <button class="btn btn-info" type="submit">Save Change</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    @endif
  </div><!-- Main Wrapper -->

  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by 5dots</p>
  </div>

</div><!-- Page Inner -->
@endsection

@section('footer_js')
<script>
  $('#state').change(function () {
    var stateId = $(this).val();
    if (stateId) {
      $.ajax({
        type: "GET",
        url: "{{url('get-cities')}}/" + stateId,
        success: function (res) {
          if (res) {
            $("#city").empty();
            $("#city").append('<option>Choose City</option>');
            $.each(res, function (key, value) {
              $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
            });

          } else {
            $("#city").empty();
          }
        }
      });
    } else {
      $("#city").empty();
    }
  });
</script>
@endsection