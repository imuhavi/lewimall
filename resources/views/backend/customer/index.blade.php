@extends('backend.master')
@section('customer_active')
active
@endsection

@section('meta_title')
@if( $page == 'index')
Seller-list
@elseif($page == 'show')
{{ Str::title($data->name) }} View
@endif
@endsection

@section('meta_description')
@if( $page == 'show')
{{ Str::limit($data->shop_address, 100) }}
@endif
@endsection

@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/customer-list') }}">Customer</a></li>
        <li class="active">Customer-list</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">
      @if ( $page == 'index')
      <div class="col-md-12">
        <div class="row mailbox-header">
          <div class="col-md-8">
            <h2>Customer List</h2>
          </div>
          <div class="col-md-4">
            <form action="{{ url(routePrefix(). '/customer-list') }}" method="GET">
              <div class="input-group">
                <input type="search" name="search" value="{{ $keyword }}" class="form-control input-search"
                  placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                </span>
              </div><!-- Input Group -->
            </form>
          </div>
        </div>

        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            {{-- --}}
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table id="" class="table table-bordered" style="width: 100%; cellspacing: 0;">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th width="120" style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $data as $key => $item )
                  <tr>
                    <td>{{ $data->firstitem() + $key }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone ?? 'Not Found' }}</td>
                    <td>
                      <a class="btn btn-sm btn-info" href="{{ url( routePrefix() . '/customer/' . $item->id) }}"><i
                          class="fa fa-eye"></i></a>
                      <form style="display: inline-block" action="{{ route('category.destroy', $item->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
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
      @elseif ($page == 'show')
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-info">

            <div class="panel-heading clearfix">
              <div class="text-left float-left">
                <h3 class="panel-title">Customer Details</h3>
              </div>
              <div class="text-right">
                <a href="{{ url( routePrefix() .'/customer-list') }}" class="btn btn-info btn-sm">Go back</a>
              </div>
            </div>

            <div class="panel-body">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th class="45%" width="45%">Customer Name:</th>
                    <td width="10%">:</td>
                    <td class="45%" width="45%">{{ $data->name }}</td>
                  </tr>

                  <tr>
                    <th class="45%" width="45%">Customer Email:</th>
                    <td width="10%">:</td>
                    <td class="45%" width="45%">{{ $data->email }}</td>
                  </tr>

                  <tr>
                    <th class="45%" width="45%">Customer Phone Number</th>
                    <td width="10%">:</td>
                    <td class="45%" width="45%">
                      {{ $data->phone }}
                    </td>
                  </tr>


                  <tr>
                    <th class="45%" width="45%">Customer Address</th>
                    <td width="10%">:</td>
                    <td class="45%" width="45%">
                      {{ $data->userDetail->postal_code }}, {{ $data->userDetail->address }}, {{
                      $data->userDetail->city->name }}, {{
                      $data->userDetail->state->name }}.
                    </td>
                  </tr>

                  <tr>
                    <th class="45%" width="45%">Customer Created</th>
                    <td width="10%">:</td>
                    <td class="45%" width="45%">
                      {{ $data->created_at->diffForHumans() }}
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by 5dots</p>
  </div>
</div><!-- Page Inner -->
@endsection