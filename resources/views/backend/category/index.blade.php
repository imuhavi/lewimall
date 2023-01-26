@extends('backend.master')
@section('category_active')
active
@endsection

@section('meta_title')
@if( $page == 'index')
Category-list
@elseif($page == 'create')
Add Category
@elseif($page == 'show')
{{ Str::title($data->name) }} View
@elseif($page == 'edit')
{{ Str::title($data->name) }} Edit
@endif
@endsection

@section('meta_description')
@if( $page == 'show' || $page == 'edit')
{{ Str::limit($data->meta_description, 100) }}
@endif
@endsection

@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/category') }}">Category</a></li>
        <li class="active">Category-list</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">

      @if($page == 'index')
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <div class="text-left">
              <h4 class="panel-title">Category List</h4>
            </div>
            <div class="text-right">
              <a class="btn btn-info btn-sm" href="{{ url(routePrefix() . '/category/create') }}">Add category</a>
            </div>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>=
                    <th>Image</th>
                    <th>Status</th>
                    <th width="120" style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <!-- <td>
                      @if($item->icon)
                      <img src="{{ asset('/backend/uploads/' . $item->icon) }}" class="small-image"
                        alt="Category icon - {{ $item->icon }}">
                      @else
                      <img src="{{ asset('backend/assets/default-img/noimage.jpg') }}" class="small-image"
                        alt="Default category icon">
                      @endif
                    </td> -->
                    <td>
                      @if($item->banner)
                      <img src="{{ asset('/backend/uploads/' . $item->banner) }}" class="small-image"
                        alt="Category banner - {{ $item->banner }}">
                      @else
                      <img src="{{ asset('backend/assets/default-img/noimage.jpg') }}" class="small-image"
                        alt="Default category banner">
                      @endif
                    </td>
                    <td>
                      <span class="badge badge-pill badge-{{ $item->status === 'Active' ? 'success' : 'danger' }}">{{
                        $item->status }}</span>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-info"
                        href="{{ url( routePrefix() . '/category/' . $item->id . '/edit') }}"><i
                          class="fa fa-edit"></i></a>
                      <a class="btn btn-sm btn-info" href="{{ url( routePrefix() . '/category/' . $item->id) }}"><i
                          class="fa fa-eye"></i></a>
                      <form style="display: inline-block" action="{{ route('category.destroy', $item->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      @elseif($page == 'create' || $page == 'edit')
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <div class="text-left">
              <h4 class="panel-title">{{ $page == 'create' ? 'Add' : 'Edit' }} Category</h4>
            </div>

            <div class="text-right">
              <a href="{{ url(routePrefix() . '/category') }}" class="btn btn-info btn-sm">Go back</a>
            </div>
          </div>
          <div class="panel-body">
            <form
              action="{{ $page == 'create' ? url(routePrefix() . '/category') : url(routePrefix() . '/category/' . $data->id) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @if($page == 'edit')
              @method('PATCH')
              @endif
              <div class="form-row">
                <div class="form-group">
                  <label for="category">Name</label>
                  <input type="text" value="{{ $data ? $data->name : old('name') }}"
                    onkeyup="pushSlug(this.value, 'category_slug')" name="name" class="form-control m-t-xxs"
                    id="category" placeholder="Name">
                  @error('name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <!-- <div class="form-row">
                <div class="form-group">
                  <label for="category_img">Upload Icon</label>
                  <input type="file" class="form-control" name="icon" id="category_img"
                    onchange="previewImage('icon', this.files)">
                  @error('icon')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <img for="category_img" class="img-thumbnail"
                  src="{{ ($page == 'create' || !$data->icon) ? asset('backend/assets/default-img/noimage.jpg') : asset('backend/uploads/' . $data->icon) }}"
                  id="icon" width="100" height="100" />
              </div> -->

              <div class="form-row">
                <div class="form-group">
                  <label for="category_banner">Upload Banner (Size: 445px × 585px)</label>
                  <input type="file" class="form-control" name="banner" id="category_banner"
                    onchange="previewImage('banner', this.files)">
                  @error('banner')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <img for="category_banner" class="img-thumbnail"
                  src="{{ ($page == 'create' || !$data->banner) ? asset('backend/assets/default-img/noimage.jpg') : asset('backend/uploads/' . $data->banner) }}"
                  id="banner" width="100" height="100" />
              </div>

              <div class="from-row status">
                <label>Publication status : </label>
                <label class="no-s">
                  @if($page == 'create')
                  <input type="checkbox" name="status" checked> Active
                  @else
                  <input type="checkbox" name="status" {{ $data->status == 'Active' ? 'checked' : '' }}> Active
                  @endif
                </label>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="category_slug">Slug</label>
                  <input type="text" value="{{ $data ? $data->slug : old('slug') }}" name="slug"
                    class="form-control m-t-xxs" id="category_slug" placeholder="Slug">
                  @error('slug')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="category">Meta title</label>
                  <input type="text" value="{{ $data ? $data->meta_title : old('meta_title') }}" name="meta_title"
                    class="form-control m-t-xxs" id="category" placeholder="Meta title">
                  @error('meta_title')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="description">Meta description</label>
                  <textarea class="form-control m-t-xxs" name="meta_description" id="description"
                    placeholder="Meta description">{{ $data ? $data->meta_description : old('meta_description') }}</textarea>
                  @error('meta_description')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <button type="submit" class="btn btn-info m-t-xs m-b-xs">{{ $page == 'create' ? 'Save' : 'Save Changes'
                }}</button>
            </form>
          </div>
        </div>
      </div>

      @elseif('show')
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">

          <div class="panel-heading clearfix">
            <div class="text-left float-left">
              <h3 class="panel-title">Category</h3>
            </div>
            <div class="text-right">
              <a href="{{ url(routePrefix() . '/category') }}" class="btn btn-info btn-sm">Go back</a>
            </div>
          </div>

          <div class="panel-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th class="45%" width="45%">Category Name</th>
                  <td width="10%">:</td>
                  <td class="45%" width="45%">{{ $data->name }}</td>
                </tr>
                <tr>
                  <th width="45%">Banner Photo</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @if($data->banner)
                    <img src="{{ asset('/backend/uploads/' . $data->banner) }}" class="thumbnail-img"
                      alt="Category Banner - {{ $data->banner }}">
                    @else
                    <img src="{{ asset('backend/assets/default-img/noimage.jpg') }}" class="thumbnail-img"
                      alt="Default category Banner">
                    @endif
                  </td>
                </tr>

                <tr>
                  <th width="45%">Category Url</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->slug }}</td>
                </tr>
                <tr>
                  <th width="45%">Meta Title</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->meta_title ?? Null }}</td>
                </tr>

                <tr>
                  <th width="45%">Meta Description</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->meta_description ?? Null }}</td>
                </tr>

                <tr>
                  <th width="45%">Category Status</th>
                  <th width="10%">:</th>
                  <td width="45%">
                    <span class="badge badge-pill badge-{{ $data->status === 'Active' ? 'success' : 'danger' }}">{{
                      $data->status }}</span>
                  </td>
                </tr>

                <tr>
                  <th width="45%">Category Create</th>
                  <th width="10%">:</th>
                  <td width="45%">{{ $data->created_at->diffForHumans() }}</td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endif

    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by stacks</p>
  </div>
</div><!-- Page Inner -->
@endsection