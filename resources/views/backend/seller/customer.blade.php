@extends('backend.master')
@section('seller_active') active open @endsection
@section('meta_title')
Seller-list
@endsection

@section('meta_description')
Seller List
@endsection

@section('subseller') active @endsection @section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li>
          <a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a>
        </li>
        <li>
          <a href="{{ url(routePrefix(). '/seller-list') }}">Seller</a>
        </li>
        <li class="active">customer-list</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="row mailbox-header">
          <div class="col-md-8">
            <h2>Customer List</h2>
          </div>
          <div class="col-md-4">
            <form action="{{ url(routePrefix() . '/seller-list') }}" method="GET">
              <div class="input-group">
                <input type="search" name="search" value="" class="form-control input-search" placeholder="Search" />
                <span class="input-group-btn">
                  <button class="btn btn-info" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
              <!-- Input Group -->
            </form>
          </div>
        </div>

        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            {{-- --}}
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table id="" class="table table-bordered" style="width: 100%; cellspacing: 0">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th width="150" style="text-align: center">Creaated</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $data as $key => $item )
                  <tr>
                    <td>{{ $data->firstitem() + $key }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->userDetail->phone }}</td>
                    <td>
                      {{ $item->created_at->diffForHumans() }}
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center"><strong>No Customer Available!</strong>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            {{ $data->links() }}
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