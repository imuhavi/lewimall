@extends('backend.master')

@section('coupon_active')
  active
@endsection

@section('meta_title')
  @if( $page == 'index')
    Coupon-list
  @elseif($page == 'create')
    Add Coupon
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
        <li><a href="{{ url(routePrefix(). '/coupon') }}">Coupon</a></li>
        <li class="active">Coupon-list</li>
      </ol>
    </div>
  </div>
  <div id="main-wrapper">

    <div class="row">
      @if ( $page == 'index')
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <div class="text-left">
              <h4 class="panel-title">Coupon List</h4>
            </div>
            <div class="text-right">
              <a class="btn btn-info btn-sm" href="{{ url(routePrefix() . '/coupon/create') }}">Add Coupon</a>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                  <tr>
                    <th>Coupon type</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Created at</th>
                    <th>Start date</th>
                    <th>Expired date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item )
                  <tr>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->created_at->diffForHumans() }}</td>
                    <td>{{ $item->start }}</td>
                    <td>{{ $item->end }}</td>
                    <td>
                      <a class="btn btn-sm btn-info"
                        href="{{ url( routePrefix() . '/coupon/' . $item->id . '/edit') }}"><i
                          class="fa fa-edit"></i></a>
                      <a class="btn btn-sm btn-info" href="{{ url( routePrefix() . '/coupon/' . $item->id) }}"><i
                          class="fa fa-eye"></i></a>
                      <form style="display: inline-block" action="{{ route('coupon.destroy', $item->id) }}"
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
      @elseif ($page == 'show')
        {{ $data }}
      @elseif ($page == 'create' || $page == 'edit')
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <h4 class="panel-title">{{ $page == 'create' ? 'Add' : 'Edit' }} Coupon</h4>
          </div>
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="panel-body">
            <form action="{{ $page == 'create' ? route('coupon.store') : route('coupon.update', $data->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @if($page == 'edit')
                @method('PATCH')
              @endif
              <div class="form-row">
                <div class="form-group">
                  <label for="name">Coupon Name</label>
                  <input type="text" value="{{ $data ? $data->name : '' }}" name="name" class="form-control m-t-xxs" id="name"
                    placeholder="Coupon name">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="coupon_code">Coupon Code</label>
                  <input type="text" value="{{ $data ? $data->code : '' }}" class="form-control m-t-xxs" id="coupon_name" name="code"
                    placeholder="Coupon Code">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="starting_date">Starting date of Coupon</label>
                  <input type="date" value="{{ $data ? $data->start : '' }}" name="start" class="form-control" id="starting_date"
                    placeholder="Ex: New Year 2021">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="end_date">End date of Coupon</label>
                  <input type="date" value="{{ $data ? $data->end : '' }}" name="end" class="form-control" id="end_date" placeholder="Ex: New Year 2021">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="type">Coupon Type</label>
                  <select class="form-control" onchange="filterCouponType(this.value)" name="type" id="type">
                    <option value="Cart" {{ ($data && $data->type == 'Cart') ? 'selected' : '' }}>Cart wise</option>
                    <option value="Product" {{ ($data && $data->type == 'Product') ? 'selected' : '' }}>Product wise</option>
                    <option value="Category" {{ ($data && $data->type == 'Category') ? 'selected' : '' }}>Category wise</option>
                  </select>
                </div>
              </div>

@php
  $category_ids = ($data && $data->category_ids) ? json_decode($data->category_ids) : [];
  $catArr = [];
  $subCatArr = [];
@endphp

@foreach($category_ids as $item)
  
  @php
    $firstElm = explode('-', $item)[0];
    $lastElm = explode('-', $item)[1];

    if($firstElm == 'category'){
      $catArr[] = $lastElm;
    }elseif($firstElm == 'sub_category'){
      $subCatArr[] = $lastElm;
    }
  @endphp

@endforeach

              <div class="form-row" style="display: none;" id="categories">
                <div class="form-group">
                  <label for="category_ids">Categories</label>
                  <select class="form-control" name="category_ids[]" id="category_ids" multiple>
                    <option value="" disabled selected>Select Categories</option>
                    @foreach($categories as $category)
                      <option value="category-{{ $category['id'] }}" {{ in_array($category['id'], $catArr) ? "selected" : "" }}>{{ $category['name'] }}</option>
                    @endforeach

                    @foreach($subCategories as $sub_category)
                      <option value="sub_category-{{ $sub_category['id'] }}" {{ in_array($sub_category['id'], $subCatArr) ? "selected" : "" }}>{{ $sub_category['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

@php
  $product_ids = ($data && $data->product_ids) ? json_decode($data->product_ids) : []
@endphp

              <div class="form-row" style="display: none;" id="products">
                <div class="form-group">
                  <label for="product_ids">Products</label>
                  <select class="form-control" name="product_ids[]" id="product_ids" multiple>
                    <option value="" disabled selected>Select Products</option>
                    @foreach($products as $product)
                      <option value="{{ $product['id'] }}" {{ in_array($product->id, $product_ids) ? 'selected' : '' }}>{{ $product['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="form-row">
                <div class="form-group">
                  <label for="discount_type">Discount Amount Type</label>
                  <select class="form-control" value="{{ $data ? $data->discount_type : '' }}" name="discount_type" id="discount_type">
                    <option value="Amount">Fixed Amount($)</option>
                    <option value="Percent">Percentage(%)</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="discount_amount">Discount Amount</label>
                  <input type="number" value="{{ $data ? $data->discount : '' }}" name="discount" class="form-control" placeholder="Ex: 50">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="min_shopping_amount">Minimum Shopping Amount</label>
                  <input type="number" value="{{ $data ? $data->min_shopping_amount : '' }}" name="min_shopping_amount" class="form-control" id="min_shopping_amount"
                    placeholder="Ex: 500">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="max_discount_amount">Max Discount Amount</label>
                  <input type="number" value="{{ $data ? $data->max_discount_amount : '' }}" name="max_discount_amount" class="form-control" id="max_discount_amount"
                    placeholder="Ex: 300">
                </div>
              </div>
              <button type="submit" class="btn btn-info m-t-xs m-b-xs">{{ $page == 'create' ? 'Save' : 'Save Changes'
                }}</button>
            </form>
          </div>
        </div>
      </div>

      <script>
        let categories = document.getElementById('categories')
        let products = document.getElementById('products')
        
        function filterCouponType(val) {
          switch (val) {
            case 'Category':
              categories.style.display = ''
              products.style.display = 'none'
              break;

            case 'Product':
              products.style.display = ''
              categories.style.display = 'none'
              break;
          
            default:
              categories.style.display = 'none'
              products.style.display = 'none'
              break;
          }
        }
      </script>

      @if($page == 'edit' && $data)
        <script>
          filterCouponType("{{ $data->type }}")
        </script>
      @endif

      @endif
    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by stacks</p>
  </div>
</div><!-- Page Inner -->
@endsection