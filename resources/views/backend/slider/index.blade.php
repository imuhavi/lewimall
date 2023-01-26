@extends('backend.master')
@section('slider_active') active open @endsection
@section('meta_title')
Slider list
@endsection

@section('meta_description')
Slider List
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
        <li class="active">Slider list</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-white">
          <a href="{{ url(routePrefix(). '/sliders/create') }}" class="btn btn-info btn-sm">Add Slider</a>
          <div class="panel-body">
            <div class="table-responsive">
              <table id="" class="table table-bordered" style="width: 100%; cellspacing: 0">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Title</th>
                    <th>Banner</th>
                    <th>Category</th>
                    <th width="120" style="text-align: center">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $data as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                      <img style="width: 200px; height: auto;" src="{{ asset('backend/uploads/' . $item->banner) }}"
                        alt="Slider Banner Image">
                    </td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                      <span class="badge badge-pill badge-{{ ($item->status == 'Active') ? 'success' : 'warning' }}">{{
                        $item->status }}</span>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-{{ ($item->status == 'Active') ? 'warning' : 'success' }}"
                        href="{{ url( routePrefix() . '/sliders/status/' . $item->id) }}"><i
                          class="fa fa-arrow-{{ ($item->status == 'Active') ? 'down' : 'up' }}"></i>
                      </a>
                      <a class="btn btn-sm btn-info" href="{{ url( routePrefix() . '/sliders/edit/' . $item->id) }}"><i
                          class="fa fa-edit"></i>
                      </a>
                      <a class="btn btn-sm btn-danger"
                        href="{{ url( routePrefix() . '/sliders/destroy/' . $item->id) }}"><i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">
                      <strong>No Slider Available!</strong>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
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