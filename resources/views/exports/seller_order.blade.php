<table class="display table" style="width: 100%; cellspacing: 0;">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Total Amount</th>
      <th>SKU Number</th>
      <th>Payment Method</th>
      <th>Status</th>
      <th>Customer</th>
      <th>Date</th>
      <th>Order Create</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($orders as $item)
    <tr>
      <td>#{{ $item->order_id }}</td>
      <td>{{ number_format($item->unit_price, 2) }}</td>
      <td>{{ $item->product->product_sku }}</td>

      <td>{{ $item->order->payment_method }}</td>
      <td>
        @if($item->order->status == 'Complete')
        @php
        $status = 'success';
        @endphp
        @elseif($item->order->status == 'Cancel')
        @php
        $status = 'danger';
        @endphp
        @elseif($item->order->status == 'Accept')
        @php
        $status = 'info';
        @endphp
        @elseif($item->order->status == 'Pending')
        @php
        $status = 'warning';
        @endphp
        @endif
        <span class="badge badge-pill badge-{{$status}}">
          {{ $item->order->status }}
        </span>
      </td>
      <td>{{ $item->order->user->name }}</td>
      <td>{{ $item->created_at->format('d-M-Y') }}</td>
      <td>{{ $item->created_at->diffForHumans() }}</td>
      <td>
        <a class="btn btn-info" href="{{ url(routePrefix(). '/order-details/' . $item->id) }}"><i
            class="fa fa-eye"></i></a>
      </td>


    </tr>
    @endforeach
  </tbody>
</table>