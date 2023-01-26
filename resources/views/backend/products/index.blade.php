@extends('backend.master')
@section('product_active') active open @endsection
@section('subproduct_active') active @endsection


@section('content')


<style>
  .content {
    position: relative;
    width: 90%;
    margin: 20px;
  }

  /* Make the image responsive */
  .content img {
    width: 100%;
    height: auto;
  }

  /* Style the button and place it in the middle of the content/image */
  .content .btn-img {
    position: absolute;
    top: 50%;
    left: 100%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    background-color: #555;
    color: white;
    font-size: 16px;
    padding: 2px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
  }

  .content .btn-img:hover {
    background-color: black;
  }
</style>

<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/product') }}">Product</a></li>
        <li class="active"> {{ (str_replace(routePrefix() . '/', '', Request::path()) == 'product-draft') ? 'Draft' : ''
          }} Product-list</li>

      </ol>
    </div>
  </div>
  <div id="main-wrapper">
    <div class="row">
      @if($page == 'index')
      <div class="col-md-12">
        <div class="row mailbox-header">
          <div class="col-md-8">
            <h4 class="panel-title">{{ (str_replace(routePrefix() . '/', '', Request::path()) == 'product-draft') ?
              'Draft' : '' }} Product List</h4>

          </div>

          <div class="col-md-2">
            <div class="text-right">
              <a href="{{ url(routePrefix(). '/product/create') }}" class="btn btn-outline-primary mb-3"> <i
                  class="icon-plus"></i>
                Add Product</a>
            </div>
          </div>

          <div class="col-md-2">
            <form action="{{ url(routePrefix() . '/product') }}" method="get">
              @csrf
              <div class="input-group">
                <input class="form-control input-search" type="search" name="keyword"
                  value="{{ isset($keyword) ? $keyword : ''  }}" placeholder="Search from here...">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
          </div>
        </div>


        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <div class="text-left">
              {{-- --}}
            </div>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>SKU</th>

                    <th>Seller</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th width="60">Subcategory</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $key => $item)
                  <tr>
                    <td>{{ $data->firstitem() + $key }}</td>
                    <td>
                      <img style="width: 50px" src="{{ asset('backend/uploads/' . $item->thumbnail) }}"
                        alt="Product thumbnail">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->product_sku }}</td>

                    <td>{{ $item->user ? $item->user->name : '' }}</td>
                    <td>{{ $item->status }}</td>

                    <td>
                      @foreach($item->productCategory as $category)
                      {{ $category->category->name }}
                      @if(!$loop->last)
                      ,
                      @endif
                      @endforeach
                    </td>

                    <td>
                      @foreach($item->productSubcatogory as $subcategory)
                      {{ $subcategory->subcategory->name }}
                      @if(!$loop->last)
                      ,
                      @endif
                      @endforeach
                    </td>
                    <td>
                      <a class="btn btn-info" href="{{ url(routePrefix(). '/product/' . $item->id) }}"><i
                          class="fa fa-eye"></i></a>
                      <a class="btn btn-warning" href="{{ url(routePrefix(). '/product/' . $item->id . '/edit') }}"><i
                          class="fa fa-edit"></i></a>
                      <a class="btn btn-danger" href="{{ url(routePrefix(). '/product/delete/' . $item->id) }}"><i
                          class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
            </div>
          </div>
        </div>
      </div>

      @elseif($page == 'create' || $page == 'edit')

      <div class="panel panel-white">
        <div class="panel-heading clearfix">
          <div class="text-left">
            <h4 class="panel-title">{{ $page == 'create' ? 'Add' : 'Edit' }} Product</h4>
          </div>

          <div class="text-right">
            <a href="{{ url(routePrefix() . '/product') }}" class="btn btn-info btn-sm">Go back</a>
          </div>
        </div>
      </div>

      <form
        action="{{ $page == 'create' ? url(routePrefix() . '/product') : url(routePrefix() . '/product/' . $data->id) }}"
        method="POST" enctype="multipart/form-data">

        @csrf

        @if($page == 'edit')
        @method('PATCH')
        @endif

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-8">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Title and Slug</h3>
                </div>
                <br>
                <div class="panel-body">

                  <div class="form-row">
                    <div class="form-group">
                      <label for="name">Product Name</label>
                      <input type="text" value="{{ $data ? $data->name : old('name') }}"
                        onkeyup="pushSlug(this.value, 'product_slug')" name="name" class="form-control m-t-xxs"
                        id="name" placeholder="Name">
                      @error('name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group">
                      <label for="product_slug">Product Url</label>
                      <input type="text" value="{{ $data ? $data->slug : old('slug') }}" name="slug"
                        class="form-control m-t-xxs" id="product_slug" placeholder="Slug">
                      @error('slug')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group">
                      <label for="productSku">Product SKU</label>
                      <input type="text" value="{{ $data ? $data->product_sku : old('product_sku') }}"
                        name="product_sku" class="form-control m-t-xxs" id="productSku" placeholder="Product Sku">
                      @error('slug')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <button type="button" class="btn btn-info" onclick="generateSku()">Generate SKU</button>

                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product description</h3>
                </div>
                <br>
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group">
                      <textarea class="form-control" name="description" id="my-editor"
                        placeholder="Meta product_description">{{ $data ? $data->description : old('description') }}</textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Information</h3>
                </div>
                <br>
                <div class="panel-body">
                  <div class="form-row">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="purchase_price">Purchase Price</label>
                            <input type="number" min="0"
                              value="{{ $data ? $data->purchase_price : old('purchase_price') }}" name="purchase_price"
                              class="form-control m-t-xxs" id="purchase_price" placeholder="Purchase Price">
                            @error('purchase_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" min="0" value="{{ $data ? $data->price : old('price') }}" name="price"
                              class="form-control m-t-xxs" id="price" placeholder="Price">
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" min="0" value="{{ $data ? $data->quantity : old('quantity') }}"
                              name="quantity" class="form-control" id="quantity" placeholder="Quantity">
                            @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                      @if($page == 'create')
                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="discount_type">Discount type</label>
                            <select name="discount_type" id="discount_type" class="form-control">
                              <option selected value="">Select Discount Type</option>
                              <option value="Percent">Percent</option>
                              <option value="Flat">Flat</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      @elseif($page == 'edit')

                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="discount_type">Discount type</label>
                            <select name="discount_type" id="discount_type" class="form-control">
                              <option selected value="">Select Discount Type</option>
                              <option value="Percent" @if($data->discount_type =='Percent' ) selected
                                @endif>Percent
                              </option>
                              <option value="Flat" @if($data->discount_type =='Flat' ) selected
                                @endif>Flat</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      @endif



                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" min="0" value="{{ $data ? $data->discount : old('discount') }}"
                              name="discount" class="form-control" id="discount" placeholder="Discount">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="unit">Unit(Kg, Cm, Pieces etc.)</label>
                            <input type="text" name="unit" id="unit" value="{{ $data ? $data->unit : old('unit') }}"
                              class="form-control">
                            @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="min">Minimum Quanity Order</label>
                            <input type="number" min="1" value="{{ $data ? $data->min : old('min') }}" name="min"
                              class="form-control" id="min" placeholder="Min">
                            @error('min')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-row">
                          <div class="form-group">
                            <label for="max">Maximum Quanity Order</label>
                            <input type="number" min="0" value="{{ $data ? $data->max : old('max') }}" name="max"
                              class="form-control" id="max" placeholder="Max">
                            @error('max')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Seo Meta Tags</h3>
                </div>
                <br>
                <div class="panel-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="meta_title" class="col-sm-2 fdots-custom-label">Meta Title</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $data ? $data->meta_title : old('meta_title') }}" name="meta_title"
                          class="form-control" id="meta_title" placeholder="Meta title">
                      </div>
                      @error('meta_title')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="meta_description" class="col-sm-2 fdots-custom-label">Meta description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="meta_description" id="meta_description"
                          placeholder="Meta description">{{ $data ? $data->meta_description : old('meta_description') }}</textarea>
                      </div>
                      @error('meta_description')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="meta_image" class="col-sm-2 fdots-custom-label">Meta Image</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="meta_image" id="meta_image"
                          onchange="previewImage('meta_image', this.files)">
                        @if($data && $data->meta_image)
                        <img height="50" width="50" src="{{ asset('backend/uploads/' . $data->meta_image) }}"
                          alt="Meta Image">
                        @endif
                      </div>
                      @error('meta_image')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-4">

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Categories</h3>
                </div>
                <br>

                <div class="panel-body">
                  @if($page == 'edit')


                  <div class="form-row">
                    <div class="form-group">
                      <label for="category">Choose Parent Category</label>
                      <select name="category_id[]" id="category" class="form-control js-example-basic-multiple"
                        multiple="multiple">
                        <option value="">Select One</option>
                        @foreach ($category as $cat_item )
                        <option value="{{ $cat_item->id }}" @if(in_array($cat_item->id, $selectProductCategory))
                          selected @endif>{{
                          $cat_item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  @else
                  <div class="form-row">
                    <div class="form-group">
                      <label for="category">Choose Parent Category</label>
                      <select name="category_id[]" id="category" class="form-control js-example-basic-multiple"
                        multiple="multiple">
                        <option value="">Select Categories</option>
                        @foreach ($category as $cat_item )
                        <option value="{{ $cat_item->id }}">{{ $cat_item->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  @endif

                  @if($page == 'edit')

                  <div class="form-row">
                    <div class="form-group">
                      <label for="sub_category">Choose Child Category</label>
                      <br>
                      <select name="sub_category_id[]" id="sub_category" class="form-control js-example-basic-multiple"
                        multiple="multiple">
                        <option value="">Choose Subcategory</option>
                        @foreach ( $subCategory as $child_item )
                        <option value="{{ $child_item->id }}" @if(in_array($child_item->id, $selectProductSubCategory))
                          selected @endif>{{ $child_item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @else

                  <div class="form-row">
                    <div class="form-group">
                      <label for="sub_category">Choose Child Category</label>
                      <br>
                      <select name="sub_category_id[]" id="sub_category" class="form-control js-example-basic-multiple "
                        multiple="multiple">
                        <option disabled value="">Choose Subcategory</option>
                        @foreach ( $subCategory as $child_item )
                        <option value="{{ $child_item->id }}">{{ $child_item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @endif

                  <div class="form-row" @if($page=='edit' && auth()->user()->role == 'Seller' ) hidden @endif>

                    <div class="form-group">
                      <label for="seller">Choose Seller</label>
                      @if(auth()->user()->role == 'Seller')
                      <select name="user_id" id="seller" class="form-control">
                        <option value="{{ auth()->user()->id }}" data-seller="{{ auth()->user()->name }}" readonly>{{
                          auth()->user()->name }}</option>
                      </select>
                      @else
                      <select name="user_id" id="seller" class="form-control">
                        <option value="" selected>Select One</option>
                        @foreach ( $sellers as $seller_item )
                        <option value="{{ $seller_item->id }}" data-seller="{{ $seller_item->name }}" {{ ($data &&
                          $seller_item->id ==
                          $data->user_id) ?
                          'selected' : ''
                          }}>{{
                          $seller_item->name }} </option>
                        @endforeach
                      </select>
                      @endif
                    </div>
                  </div>

                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Variation</h3>
                </div>
                <br>
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group">
                      <label for="attributes">Product Attribute:(add attribute and value) </label>
                      <br>

                      @php
                      $old_attributes = $data ? json_decode($data->attributes) : [];
                      $old_attributes_arr = [];
                      @endphp

                      @if(!empty($old_attributes))
                      @foreach($old_attributes as $old_attribute)
                      @php
                      $old_attributes_arr[] = explode(',', str_replace('"', '', str_replace(']', '', str_replace('[',
                      '', $old_attribute))))[1];
                      @endphp
                      @endforeach
                      @endif

                      @foreach($attributes as $item)
                      {{ $loop->iteration }}. {{ $item->name }}


                      <select name="attributes[]" class="form-control" multiple>

                        @foreach(json_decode($item->value) as $value)
                        <option @if(in_array($value, $old_attributes_arr)) selected @endif
                          value="{{ $item->id .'-'. $value }}">{{ $value }}</option>
                        @endforeach

                      </select>

                      <br>

                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Attachment</h3>
                </div>
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group">
                      <label for="pdf">Upload Pdf</label>
                      @if($data && $data->pdf)
                      <a href="{{ asset('backend/uploads/' . $data->pdf) }}" target="_blank">Show PDF</a>
                      @endif
                      <input type="file" class="form-control" name="pdf" id="pdf">
                    </div>

                    <div class="form-group">
                      <label for="images">Upload Product Images (Size: 1:1)</label>
                      <input type="file" class="form-control" name="images[]" id="images" multiple>
                      @error('images')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                      @if($page == 'edit' && $data->images)
                      <div class="row">
                        @foreach($data->images as $image)
                        <div class="col-md-6">
                          <div class="content">
                            <img src="{{ asset('backend/uploads/' . $image->image) }}" alt="Product images">
                            <a href="{{ url(routePrefix() . '/product/image/delete/' . $image->id) }}"
                              class="btn-img btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                          </div>
                        </div>
                        @endforeach
                      </div>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="thumbnail">Upload Thumbnail Image (Size: 1:1)</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                        onchange="previewImage('feature', this.files)">
                      @error('thumbnail')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <img class="img-thumbnail"
                      src="{{ ($page == 'create' || !$data->thumbnail) ? asset('backend/assets/default-img/noimage.jpg') : asset('backend/uploads/' . $data->thumbnail) }}"
                      id="feature" width="100" height="100" />
                  </div>

                  @if(auth()->user()->role == 'Admin')
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

                  <div class="from-row status">
                    <label>Cash on delivery Available : </label>
                    <label class="no-s">
                      @if($page == 'create')
                      <input type="checkbox" name="isCashAvailable"> Active
                      @else
                      <input type="checkbox" name="isCashAvailable" {{ $data->isCashAvailable == 1 ? 'checked' :
                      '' }}> Active
                      @endif
                    </label>
                  </div>

                  @endif
                  <div class="from-row status">
                    <label>Draft : </label>
                    <label class="no-s">
                      @if($page == 'create')
                      <input type="checkbox" name="is_draft"> Active
                      @else
                      <input type="checkbox" name="is_draft" {{ $data->is_draft == 1 ? 'checked' : '' }}> Active
                      @endif
                    </label>
                  </div>



                  <div class="from-row">
                    <button type="submit" class="btn btn-info m-t-xs m-b-xs">{{ $page == 'create' ? 'Publish' :
                      'Save
                      Changes'
                      }}</button>
                  </div>

                </div>
              </div>


              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Product Tags</h3>
                </div>
                <br>
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group">
                      <label for="tags">Tags</label>
                      <input type="text" value="{{ $data ? $data->tags : old('tags') }}" name="tags"
                        class="form-control" id="tags" placeholder="Tags" data-role="tagsinput">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      @elseif($page == 'show')

      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">

          <div class="panel-heading clearfix">
            <div class="text-left float-left">
              <h3 class="panel-title">Product</h3>
            </div>
            <div class="text-right">
              <a href="{{ url(routePrefix() . '/product') }}" class="btn btn-info btn-sm">Go back</a>
            </div>
          </div>

          <div class="panel-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th class="45%" width="45%">Product Name</th>
                  <td width="10%">:</td>
                  <td class="45%" width="45%">{{ $data->name }}</td>
                </tr>
                <tr>
                  <th class="45%" width="45%">Product Url</th>
                  <td width="10%">:</td>
                  <td class="45%" width="45%">{{ $data->slug }}</td>
                </tr>
                <tr>
                  <th class="45%" width="45%">Product Sku</th>
                  <td width="10%">:</td>
                  <td class="45%" width="45%">{{ $data->product_sku }}</td>
                </tr>
                <tr>
                  <th width="45%">Product thumbnail</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @if($data->thumbnail)
                    <img src="{{ asset('backend/uploads/' . $data->thumbnail) }}" class="thumbnail-img"
                      alt="Product Thumbnail - {{ $data->thumbnail }}">
                    @else
                    <img src="{{ asset('backend/assets/default-img/noimage.jpg') }}" class="thumbnail-img"
                      alt="Default category Banner">
                    @endif
                  </td>
                </tr>

                @if(!empty($colors))
                <tr>
                  <th width="45%">Color</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @foreach($colors as $color)
                    {{ $color }}<br>
                    @endforeach
                  </td>
                </tr>
                @endif

                @if(!empty($sizes))
                <tr>
                  <th width="45%">Sizes</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @foreach($sizes as $size)
                    {{ $size }}<br>
                    @endforeach
                  </td>
                </tr>
                @endif

                <tr>
                  <th width="45%">Parent Category</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @foreach($data->productCategory as $category)
                    {{ $category->category->name }}
                    @if(!$loop->last)
                    ,
                    @endif
                    @endforeach
                  </td>
                </tr>

                <tr>
                  <th width="45%">Child Category</th>
                  <td width="10%">:</td>
                  <td width="45%">
                    @foreach($data->productSubcatogory as $subcategory)
                    {{ $subcategory->subcategory->name }}
                    @if(!$loop->last)
                    ,
                    @endif
                    @endforeach
                  </td>
                </tr>

                <tr>
                  <th width="45%">Seller Name</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->user ? $data->user->name : '' }}</td>
                </tr>

                <tr>
                  <th width="45%">Product Quantity</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->quantity }}</td>
                </tr>

                <tr>
                  <th width="45%">Price</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->price }}</td>
                </tr>

                <tr>
                  <th width="45%">Discount</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->discount_type ?? Null }}</td>
                </tr>

                <tr>
                  <th width="45%">Discount Amount</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->discount ?? Null }}{{ $data->discount_type == 'Percent' ? '%' : 'SAR' }}
                  </td>
                </tr>

                <tr>
                  <th width="45%">Meta Description</th>
                  <td width="10%">:</td>
                  <td width="45%">{{ $data->meta_description ?? Null }}</td>
                </tr>

                <tr>
                  <th width="45%">Product Status</th>
                  <th width="10%">:</th>
                  <td width="45%">
                    <span class="badge badge-pill badge-{{ $data->status === 'Active' ? 'success' : 'danger' }}">{{
                      $data->status }}</span>
                  </td>
                </tr>

                <tr>
                  <th width="45%">Product Create</th>
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
    <p class="no-s">Made with <i class="fa fa-heart"></i> by 5dots</p>
  </div>
</div><!-- Page Inner -->
@endsection

@section('footer_js')
<script>
  // $('#category').change(function () {
  //   let categoryId = $(this).val();
  //   if (categoryId) {
  //     $.ajax({
  //       type: "GET",
  //       url: "{{url('get-subcategory')}}/" + categoryId,
  //       success: function (res) {
  //         if (res) {
  //           $("#sub_category").empty();
  //           $("#sub_category").append('<option>Choose Subcategory</option>');
  //           $.each(res, function (key, value) {
  //             $("#sub_category").append('<option value="' + value.id + '">' + value.name + '</option>');
  //           });

  //         } else {
  //           $("#sub_category").empty();
  //         }
  //       }
  //     });
  //   } else {
  //     $("#sub_category").empty();
  //   }
  // });

  $(document).ready(function () {
    $('.js-example-basic-multiple').select2();
  });

  let productSku = document.getElementById('productSku');
  let seller = document.getElementById('seller');


  function sellerName() {
    return seller.options[seller.selectedIndex].textContent.toLowerCase().replace(' ', '_')
  }
  function generateSku() {
    console.log(seller.value.length, sellerName().length, sellerName())
    if (seller.value.length > 0 && sellerName().length > 1 && sellerName() != 'select_one') {
      productSku.value = sellerName().slice(0, 2).toUpperCase() + '-' + (Math.floor(1000 + Math.random() * 9000)).toString() + '-' + seller.value
    } else {
      alert('Please select a seller.');
    }
  }


</script>
@endsection