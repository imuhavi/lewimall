<div class="offcanvas-header">
  <h5 id="offcanvasRightLabel">Shopping Cart</h5>
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
  <div class="order-summary">
    <div class="heading-checkout">
      <h5>Your Order Items</h5>
    </div>

    @php
    $cart = getCart()
    @endphp

    @foreach($cart['cart'] as $key => $item)
    <div class="row order-item">
      <div class="col-3">
        <img class="rounded w-75" src="{{ asset('backend/uploads/' . $item['product_url']) }}" alt="Product image">
      </div>
      <div class="col-6">
        <p>{{ $item['product_name'] }}</p>
        <p>
          <small>
            (Color: {{ ucfirst($item['color']) }}, Size: {{ ucfirst($item['size']) }})
          </small>
        </p>
        <p>Quanity: {{ $item['quantity'] }}</p>
      </div>
      <div class="col-3 text-end">
        <p>SA {{ number_format(($item['product_price'] * $item['quantity']) - $item['discount'], 2) }}</p>
        <button type="button" onclick="removeCart('{{ $key }}')" style="border: none;">
          <span class="cart-item-del"><i class="fas fa-trash-alt"></i></span>
        </button>
      </div>
    </div>
    @endforeach
  </div>
  <div class="order-calculation">
    <div class="row">
      <div class="col-6">
        <h5>Total Amount</h5>
      </div>
      <div class="col-6">
        <h5 class="price-text sub-total-text text-end"> SA {{ number_format($cart['total'], 2) }} </h5>
      </div>
    </div>
  </div>
</div>
<div class="place-order">
  @if(Auth::check())
  <a href="{{ route('checkout') }}" class="place-order-button">Process To Checkout</a>
  @else
  <a href="{{ route('checkout') }}" class="place-order-button">Process To Checkout</a>
  @endif
</div>
</div>