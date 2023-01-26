@extends('backend.master')
@section('mail-box') active open @endsection
@section('compose') active @endsection
@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/compose') }}">Compose</a></li>
        <li class="active">Compose</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="mailbox-content mailbox-compose">
          <div class="compose-body">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="to" class="col-sm-2 control-label">To</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="to">
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="subject">
                </div>
              </div>
            </form>
          </div>
          <div class="compose-message">
            <div class="summernote"></div>
          </div>
          <div class="compose-options">
            <div class="pull-right">
              <a href="inbox.html" class="btn btn-success"><i class="fa fa-send m-r-xs"></i>Send</a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by stacks</p>
  </div>
</div><!-- Page Inner -->
@endsection