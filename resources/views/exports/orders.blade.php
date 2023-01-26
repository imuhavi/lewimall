<table class="display table" style="width: 100%; cellspacing: 0;">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Total Amount</th>
      <th>Order Create</th>
      <th>Payment Method</th>
      <th>Status</th>
      <th>Customer</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>

    @foreach($orders as $item)
    <tr>
      <td>#{{ $item->id }}</td>
      <td>
        SA {{ $item->amount + $item->shipping_cost + $item->tax - $item->coupon_discount_amount }}
      </td>
      <td>
        {{ $item->created_at->diffForHumans() }}
      </td>


      <td>
        {{ $item->payment_method }}
      </td>
      <td>
        @if($item->status == 'Complete')
        @php
        $status = 'success';
        @endphp
        @elseif($item->status == 'Cancel')
        @php
        $status = 'danger';
        @endphp
        @elseif($item->status == 'Accept')
        @php
        $status = 'info';
        @endphp
        @elseif($item->status == 'Pending')
        @php
        $status = 'warning';
        @endphp
        @endif
        <span class="badge badge-pill badge-{{$status}}">
          {{ $item->status }}
        </span>
      </td>
      <td>
        {{ $item->user->name }}
      </td>

      <td>{{ $item->created_at->format('d-M-Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>