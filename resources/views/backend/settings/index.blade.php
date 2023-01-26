@extends('backend.master')
@section('settings_active') active @endsection

@section('meta_title')
{{ __('Websites Settings') }}
@endsection

@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <h3 class="panel-title">Settings</h3>
          </div>

          <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              {{-- General Settings --}}
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#general_settings" aria-expanded="true"
                      aria-controls="collapseOne">
                      General Settings
                    </a>
                  </h4>
                </div>

                <div id="general_settings" class="panel-collapse collapse in" role="tabpanel"
                  aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="tabs-left" role="tabpanel">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#generalSetting" role="tab"
                            data-toggle="tab">General Settings</a></li>
                        <li role="presentation"><a href="#seo" role="tab" data-toggle="tab">SEO</a>
                        </li>

                        <li role="presentation"><a href="#mail" role="tab" data-toggle="tab">Mail Configuration</a>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Socail Login Settings --}}
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#socail_login"
                      aria-expanded="false" aria-controls="collapseTwo">
                      Social Logins
                    </a>
                  </h4>
                </div>

                <div id="socail_login" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <div class="tabs-left" role="tabpanel">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#google" role="tab" data-toggle="tab">Google</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Payment Getway Setup --}}
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#payment_method"
                      aria-expanded="false" aria-controls="collapseTwo">
                      Payment Methods
                    </a>
                  </h4>
                </div>


                <div id="payment_method" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">


                    <div class="tabs-left" role="tabpanel">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#payment" role="tab" data-toggle="tab">Setup Payment Methods
                          </a></li>
                      </ul>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">

        <div class="panel panel-white">
          <div class="panel-body">
            <!-- Tab panes -->
            <div class="tab-content">
              {{-- General Settings --}}
              <div role="tabpanel" class="tab-pane active fade in" id="generalSetting">
                <div class="card mb-4">
                  <form action="{{ url(routePrefix() . '/settings-update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Website Name</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="text" name="app_name" id="website_title" class="form-control"
                            value="{{ $data->app_name ?? '' }}">
                          @error('app_name')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Website Logo (White)</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="file" accept="image/*" onchange="previewImage('whiteLogo', this.files)"
                            name="app_logo_white" id="app_logo_white" class="form-control">
                        </div>
                        <div class="col-sm-4" style="margin-top: 10px">
                          @if($data->app_logo_white ?? '')
                          <img class="img avatar" id="whiteLogo"
                            src="{{ asset('backend/uploads/' . $data->app_logo_white) }}" alt="" width="80px"
                            height="80px">
                          @else
                          <img class="img avatar" id="whiteLogo"
                            src="{{ asset('backend/assets/default-img/user.jpeg') }}" alt="" width="80px" height="80px">
                          @endif
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Website Logo (Black)</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="file" accept="image/*" onchange="previewImage('blackLogo', this.files)"
                            name="app_logo_black" id="app_logo_black" class="form-control">
                        </div>
                        <div class="col-sm-4" style="margin-top: 10px">
                          @if($data->app_logo_black ?? '')
                          <img class="img avatar" id="blackLogo"
                            src="{{ asset('backend/uploads/' . $data->app_logo_black) }}" alt="" width="80px"
                            height="80px">
                          @else
                          <img class="img avatar" id="blackLogo"
                            src="{{ asset('backend/assets/default-img/user.jpeg') }}" alt="" width="80px" height="80px">
                          @endif
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Website Email</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="email" id="email" class="form-control" name="app_email"
                            value="{{ $data->app_email ?? '' }}">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Web Mobile Number</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="tel" name="app_phone" class="form-control" value="{{ $data->app_phone ?? '' }}"
                            id="phone">
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="app_address" id="address"
                            class="form-control">{{ $data->app_address ?? '' }}</textarea>
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Shipping Cost</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="number" name="shipping_cost" class="form-control"
                            value="{{ $data->shipping_cost ?? '' }}" id="phone">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Shipping Days</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="number" name="shipping_days" class="form-control"
                            value="{{ $data->shipping_days ?? '' }}" id="shipping_days">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Tax</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="number" name="tax" class="form-control" value="{{ $data->tax ?? '' }}" id="tax">
                        </div>

                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Copyright Text</p>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="app_copyright_text" id="address"
                            class="form-control">{{ $data->app_copyright_text ?? '' }}</textarea>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12 text-right ">
                          <button class="btn btn-info" type="submit">Update</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              {{-- SEO Settings --}}
              <div role="tabpanel" class="tab-pane fade" id="seo">
                <div class="card mb-4">
                  <form action="{{ url(routePrefix() . '/settings-seo-update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Meta Title</p>
                        </div>
                        <div class="col-sm-9">
                          <input type="text" name="seo_title" id="seo_title" class="form-control"
                            value="{{ $data->seo_title ?? '' }}">
                          @error('seo_title')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Meta Description</p>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="seo_description" id="seo_description"
                            class="form-control">{{ $data->seo_description ?? '' }}</textarea>
                          @error('seo_description')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Meta Keyword</p>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="seo_keywords" id="seo_keywords"
                            class="form-control">{{ $data->seo_keywords ?? '' }}</textarea>
                          @error('seo_keywords')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>

                      <div class="row" style="margin-top: 20px">
                        <div class="col-sm-12 text-right ">
                          <button class="btn btn-info" type="submit">Update</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>

              {{-- Mail Setup Settings --}}
              <div role="tabpanel" class="tab-pane fade" id="mail">
                <div class="card mb-4">
                  <form action="{{ url(routePrefix() . '/settings-mail-update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Type</p>
                        </div>
                        <div class="col-sm-5">
                          <select name="mail_type" id="" class="form-control">
                            <option value="" selected disabled>Select Type</option>
                            <option value="SMTP" @if($data->mail_type ?? '' == 'SMTP') selected @endif>SMTP</option>
                          </select>
                        </div>
                      </div>
                      <hr>

                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Host</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="mail_host" value="{{ $data->mail_host ?? '' }}" class="form-control"
                            id="mail_host">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Port</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="number" value="{{ $data->mail_port ?? '' }}" name="mail_port"
                            class="form-control" id="mail_port">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Username</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="mail_username" value="{{ $data->mail_username ?? '' }}"
                            class="form-control" id="mail_username">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Password</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="password" name="mail_password" value="{{ $data->mail_password ?? '' }}"
                            class="form-control" id="mail_password">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Encryption</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="mail_encryption" value="{{ $data->mail_encryption ?? '' }}"
                            class="form-control" id="mail_encryption">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail Address</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="email" name="mail_address" value="{{ $data->mail_address ?? '' }}"
                            class="form-control" id="mail_address">
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Mail From Name</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="mail_from_name" value="{{ $data->mail_from_name ?? '' }}"
                            class="form-control" id="mail_from_name">
                        </div>
                      </div>

                      <div class="row" style="margin-top: 20px">
                        <div class="col-sm-8 text-right ">
                          <button class="btn btn-info" type="submit">Save Configuration</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>

              {{-- Social Login Google --}}
              <div role="tabpanel" class="tab-pane fade" id="google">
                <div class="card mb-4">
                  <form action="{{ url(routePrefix() . '/settings-social-update') }}" method="POST">
                    @csrf
                    <div class="card-body">

                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">App Id</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="app_id" value="{{ $data->app_id ?? '' }}" id="app_id"
                            class="form-control">
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">App Secret</p>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" name="app_secret" value="{{ $data->app_secret  ?? ''}}"
                            class="form-control" id="app_secret">
                        </div>
                      </div>

                      <div class="row" style="margin-top: 20px">
                        <div class="col-sm-8 text-right ">
                          <button class="btn btn-info" type="submit">Update</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              {{-- Payment Method --}}
              <div role="tabpanel" class="tab-pane fade" id="payment">
                <div class="card mb-4">
                  <form action="{{ route('settings.payment.update') }}" method="post">
                    @csrf
                    <div class="card-body">

                      <div class="row">
                        <div class="col-sm-3">
                          <p class="mb-0">Publisable Key</p>
                        </div>
                        <div class="col-sm-9">
                          <textarea name="myfatoorah_token" style="height: 250px; width: 100%;"
                            class="form-control">{{ env('MYFATOORAH_TOKEN') }}</textarea>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 20px">
                        <div class="col-sm-8 text-right ">
                          <button class="btn btn-info" type="submit">Update</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
@endsection