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
        <li class="active">Seller-list</li>
      </ol>
    </div>
  </div>

  <div id="main-wrapper">
    <div class="row">
      @if ( $page == 'index')
      <div class="col-md-12">
        <div class="row mailbox-header">
          <div class="col-md-8">
            <h2>Seller List</h2>
          </div>
          <div class="col-md-4">
            <form action="{{ url(routePrefix() . '/seller-list') }}" method="GET">
              <div class="input-group">
                <input type="search" name="search" value="{{ $search }}" class="form-control input-search"
                  placeholder="Search" />
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
                    <th>Phone Number(s)</th>
                    <th>Created</th>
                    <th width="120" style="text-align: center">
                      Action
                    </th>
                    <th width="120" style="text-align: center">
                      Shop status
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $data as $key => $item )
                  <tr style="color:{{ ($item->shop->status == 'Inactive') ? 'red' : '' }}">
                    <td>{{ $data->firstitem() + $key }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                      @if($item->phone)
                      {{ $item->phone }}
                      @else
                      <span class="text-danger">No number added</span>
                      @endif
                    </td>
                    <td>{{ $item->created_at->diffForHumans() }}</td>
                    <td style="text-align: center">
                      <a class="btn btn-sm btn-info" title="View Profile"
                        href="{{ url( routePrefix() . '/seller/' . $item->id) }}">
                        <i class="fa fa-eye"></i>
                      </a>

                      <a class="btn btn-sm btn-danger" title="Edit Profile"
                        href="{{ route('sellerProfile', $item->id) }}">
                        <i class="icon icon-note"></i>
                      </a>


                    </td>
                    <td style="text-align: center">
                      @if($item->shop && (strtotime('+' . $item->shop->subscription->days . ' day',
                      strtotime($item->shop->created_at)) > strtotime('now')))
                      <a class="btn btn-sm btn-{{ ($item->shop->status == 'Active') ? 'success' : 'danger' }}"
                        href="{{ url( routePrefix() . '/shop/' . $item->shop->id) }}">
                        <i class="icon-check"></i>
                      </a>
                      @endif

                      <a title="send mail" class="btn btn-sm btn-warning" id="sendMail"
                        href="{{ route('sendAlert', $item->id) }}" onclick="handleSubmit()"><i
                          class="icon-envelope"></i></a>

                      <a class="btn btn-sm btn-danger" id="loading" style="display: none;"
                        href="{{ route('sendAlert', $item->id) }}" onclick="handleSubmit()"><i class="icon-ban"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">
                      <strong>No Seller Available!</strong>
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
      @endif
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
@section('footer_js')
<script>
  let send = document.getElementById('sendMail');
  let loading = document.getElementById('loading');

  const handleSubmit = () => {
    loading.style.display = '',
      send.style.display = 'none'
  }
</script>
@endsection