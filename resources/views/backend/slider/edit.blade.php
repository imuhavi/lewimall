@extends('backend.master')
@section('slider_active') active open @endsection
@section('meta_title')
Slider Edit
@endsection

@section('meta_description')
Slider Edit
@endsection

@section('slider') active @endsection @section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li>
          <a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a>
        </li>
        <li>
          <a href="{{ url(routePrefix(). '/sliders') }}">Slider</a>
        </li>
        <li class="active">Slider Edit</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-white">
          <a href="{{ url(routePrefix(). '/sliders') }}" class="btn btn-info btn-sm">Go back</a>
          <div class="panel-body">
            <div class="table-responsive">
              <form action="{{ route('sliderUpdate', $slider->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner (Size: 1024px × 240px)</p>
                    </div>
                    <div class="col-sm-5">
                      <input type="file" accept="image/*" onchange="previewImage('slider_banner_preview', this.files)"
                        name="banner" id="banner" class="form-control">
                    </div>
                    <div class="col-sm-4">
                      <img class="img avatar" id="slider_banner_preview"
                        src="{{ asset('backend/uploads/' . $slider->banner) }}" alt="" width="80px" height="80px">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Sub Title</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="title" value="{{ $slider->sub_title }}" id="sub_title"
                        class="form-control">
                      @error('sub_title')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Title</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="title" value="{{ $slider->title }}" placeholder="Enter a title"
                        id="title" class="form-control">
                      @error('title')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Category</p>
                    </div>
                    <div class="col-sm-9">
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="" selected disabled>Select Category</option>
                        @foreach($category as $item)
                        <option @if($slider->category_id == $item->id) selected @endif value="{{ $item->id }}">{{
                          $item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
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
        </div>
      </div>
    </div>
    <!-- Row -->
  </div>
  <!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by 5dots</p>
  </div>
</div>
<!-- Page Inner -->
@endsection