@extends('backend.master')
@section('attributes_active')
active
@endsection
@section('content')
<div class="page-inner">
  <div class="page-title">
    <div class="page-breadcrumb">
      <ol class="breadcrumb breadcrumb-with-header">
        <li><a href="{{ url(routePrefix(). '/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url(routePrefix(). '/attributes') }}">Attributes</a></li>
        <li class="active">Attributes-list</li>
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
              <h4 class="panel-title">Attributes List</h4>
            </div>

            <div class="text-right">
              <a class="btn btn-info btn-sm" href="{{ url(routePrefix() . '/attributes/create') }}">Add
                Attributes</a>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th width="120" style="text-align: center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $data as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                      @php
                      $last_key = count(json_decode($item->value)) - 1
                      @endphp
                      @foreach(json_decode($item->value) as $key => $value)
                      {{ $value }}
                      @if($key !== $last_key)
                      {{ ', ' }}
                      @endif
                      @endforeach
                    </td>
                    <td>
                      <a class="btn btn-sm btn-info"
                        href="{{ url(routePrefix().'/attributes/'. $item->id).'/edit' }}"><i class="fa fa-edit"></i></a>
                      <form style="display: inline-block" action="{{ route('attributes.destroy', $item->id) }}"
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
      @elseif ($page == 'create' || $page == 'edit' )
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-white">
          <div class="panel-heading clearfix">
            <div class="text-left">
              <h4 class="panel-title">{{ $page == 'create' ? 'Add' : 'Edit' }} Attributes</h4>
            </div>

            <div class="text-right">
              <a href="{{ url(routePrefix() . '/attributes') }}" class="btn btn-info btn-sm">Go back</a>
            </div>
          </div>
          <div class="panel-body">
            <form
              action="{{ $page == 'create' ? url(routePrefix() . '/attributes') : url(routePrefix() . '/attributes/' . $data->id) }}"
              method="post">
              @csrf
              @if ($page == 'edit')
              @method('PATCH')
              @endif
              <div class="form-row">
                <div class="form-group">
                  <label for="attribute">Attribute Name</label>
                  <button type="button" class="btn btn-sm btn-success" onclick="addValueField()">Add value
                    field</button>
                  <input type="text" class="form-control m-t-xxs" id="attribute" placeholder="attribute name"
                    name="name" value="{{ $data ? $data->name : old('name')}}">
                  @error('name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              @if($page == 'edit')
              <label for="attribute">Attribute Values</label>
              <div class="form-row">
                <div class="form-group">
                  <input type="text" class="form-control m-t-xxs"
                    value="{{ $data ? $data->value : old('attribute_value')}}" placeholder="attribute values"
                    name="attribute_value" required>
                </div>
              </div>
              @else
              <label for="attribute">Attribute Values</label>
              <div class="form-row">
                <div class="form-group">
                  <input type="text" class="form-control m-t-xxs" placeholder="attribute value" name="attribute_value[]"
                    required>
                </div>
              </div>
              <div id="attributeValues"></div>
              @endif

              @error('attribute_value')
              <small class="text-danger">{{ $message }}</small>
              @enderror

              <button type="submit" class="btn btn-info m-t-xs m-b-xs">{{ $page == 'create' ? 'Save' : 'Save Changes'
                }}</button>
            </form>
          </div>
        </div>
      </div>
      <script>
        function addValueField() {
          let newField = `<div class="form-row">
                            <div class="form-group" id="">
                              <div class="col-sm-10">
                                <input type="text" class="form-control m-t-xxs" placeholder="attribute value"
                                      name="attribute_value[]" required>
                              </div>
                              <div class="col-sm-2">
                                <button type="button" onclick="this.parentNode.parentNode.remove()" class="btn btn-sm btn-danger">-</button>
                              </div>
                            </div>
                          </div>`
          $('#attributeValues').append(newField)
        }
      </script>
      @endif
    </div><!-- Row -->
  </div><!-- Main Wrapper -->
  <div class="page-footer">
    <p class="no-s">Made with <i class="fa fa-heart"></i> by stacks</p>
  </div>
</div><!-- Page Inner -->
@endsection