@foreach($data as $item)

@php
$discountAmount = ($item->price - ($item->discount / 100) * $item->price);
$discount = (($item->discount * 100) / $item->price)
@endphp

<div class="col-md-4 text-center">
  <div class="product-content">
    @if($item->discount !== null && $item->discount_type == 'Percent')
    <p class="label">{{ round($item->discount)}}%</p>
    @elseif($item->discount !== null && $item->discount_type == 'Flat')
    <p class="label">{{ $item->discount}}SR</p>
    @endif
    <div class="proudct-img">
      <a href="{{ route('productView', $item->slug) }}">
        <img class="img-fluid" src="{{ asset('backend/uploads/' . $item->thumbnail) }}" alt="product-12">
      </a>
      <div class="overlay">
        <div class="action">
          <span><a href="{{ route('productView', $item->slug) }}"><i class="fas fa-eye"></i></a></span>
          <span><a href="#"><i class="far fa-heart"></i></a></span>
        </div>
      </div>
    </div>
    <a href="{{ route('productView', $item->slug) }}" class="product-title d-block mt-3">
      {{Str::limit($item->name, 25)}}
    </a>
    @if($item->discount !== null && $item->discount_type == 'Percent')
    <h3 class="new-price my-2">{{ round($discountAmount)}} SAR</h3>
    <p class="old-price text-danger">{{ $item->price }}SAR</p>
    @elseif($item->discount !== null && $item->discount_type == 'Flat')
    <h3 class="new-price my-2">{{ $item->price- $item->discount }}SAR</h3>
    <p class="old-price text-danger">{{ $item->price }}SAR</p>
    @else
    <h3 class="new-price my-2">{{ $item->price }}SAR</h3>
    @endif
  </div>
</div>
@endforeach