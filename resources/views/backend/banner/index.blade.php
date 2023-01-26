@extends('backend.master')
@section('banner_active') active open @endsection
@section('meta_title')
Banner
@endsection

@section('meta_description')
Banner
@endsection
@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Dashboard</li>
        <li class="active">Banner</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-white">

          <div class="panel-body">
            <div class="table-responsive">
              <form action="{{ route('banner.update.one') }}" method="post" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 1 (Size: 1024px × 242px)</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="file" accept="image/*" onchange="previewImage('banner_preview_one', this.files)"
                        name="bannerOne" id="banner" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 1 Preview</p>
                    </div>
                    <div class="col-sm-9">
                      <img class="img avatar" id="banner_preview_one"
                        src="{{ asset('backend/uploads/' . $banner_one->banner ?? '') }}" alt="" width="100%"
                        height="242px">
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Title</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="title" placeholder="Enter a title" id="title"
                        value="{{ $banner_one->title ?? '' }}" class="form-control">
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
                        <option disabled>Select Category</option>
                        @foreach($category as $item)
                        <option value="{{ $item->id }}" {{ $banner_one->category_id == $item->id ? 'selected' : ''}}>{{
                          $item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Publication Status:</p>
                    </div>
                    <label>
                      <input type="checkbox" name="status" {{ $banner_one->status == 'Active' ? 'checked': '' }}> Active
                      Banner One
                    </label>
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

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-white">

          <div class="panel-body">
            <div class="table-responsive">
              <form action="{{ route('banner.update.two') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 2 (Size: 1024px × 242px)</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="file" accept="image/*" onchange="previewImage('banner_preview_two', this.files)"
                        name="bannerTwo" id="banner" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 2 Preview</p>
                    </div>
                    <div class="col-sm-9">
                      <img class="img avatar" id="banner_preview_two"
                        src="{{ asset('backend/uploads/' . $bannerTwo->banner) }}" alt="" width="100%" height="242px">
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Title</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="title" placeholder="Enter a title" id="title"
                        value="{{ $bannerTwo->title ?? '' }}" class="form-control">
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
                        <option disabled>Select Category</option>
                        @foreach($category as $item)
                        <option value="{{ $item->id }}" {{ $bannerTwo->category_id == $item->id ? 'selected' : '' }}>{{
                          $item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Publication Status:</p>
                    </div>
                    <label>
                      <input type="checkbox" name="status" {{ $bannerTwo->status == 'Active' ? 'checked' : '' }}> Active
                      Banner Two
                    </label>
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

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-white">

          <div class="panel-body">
            <div class="table-responsive">
              <form action="{{ route('banner.update.three') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 3 (Size: 1024px × 242px)</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="file" accept="image/*" onchange="previewImage('banner_preview_three', this.files)"
                        name="bannerThree" id="banner" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Banner 3 Preview</p>
                    </div>
                    <div class="col-sm-9">
                      <img class="img avatar" id="banner_preview_three"
                        src="{{ asset('backend/uploads/' . $bannerThree->banner ) }}" alt="" width="100%"
                        height="242px">
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Title</p>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="title" placeholder="Enter a title" id="title"
                        value="{{ $bannerThree->title ?? '' }}" class="form-control">
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
                        <option disabled>Select Category</option>
                        @foreach($category as $item)
                        <option value="{{ $item->id }}" {{ $bannerThree->category_id == $item->id ? 'selected' : '' }}">
                          {{ $item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Publication Status:</p>
                    </div>
                    <label>
                      <input type="checkbox" name="status" {{ $bannerThree->status == 'Active' ? 'checked' : '' }}>
                      Active Banner Three
                    </label>
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
  </div>
</div>
@endsection