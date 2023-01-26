<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin: 0;
    }

    ul,
    ol,
    ul li,
    p {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .container {
      width: 1220px;
      margin: 0 auto;
    }

    .hedaer {
      padding: 15px 0px;
      background-color: rgb(108, 108, 108);
      border-radius: 10px;
    }

    .hedaer h3 {
      text-align: center;
      color: #fff;
      font-size: 20px;
      text-transform: uppercase;
    }

    .row {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .invoice-to ul li {
      padding: 2px 0;
    }

    .invoce-no ul li {
      padding: 2px 0;
      text-align: right;
    }

    .table-dark {
      background-color: black;
      color: #fff;

    }

    .col-12,
    table {
      width: 100%;
      overflow-x: scroll;
    }

    table th {
      padding: 15px 10px;

    }

    .table-light {
      background: rgb(232, 232, 232);
      margin-top: 20px;
    }

    .table-light tr td {
      padding: 10px;
      text-align: center;
    }

    .calculation {
      width: 100%;
      display: flex;
      justify-content: flex-end;
    }

    .calculation tr td {
      padding: 5px;
      text-align: right;
    }

    .btn-success {
      background-color: black;
      padding: 10px;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .
  </style>
</head>

<body>
  <header>
    <div class="container">
      <div class="hedaer">
        <h3>Invoice</h3>
      </div>
    </div>
  </header>
  <main>
    <section class="container">
      <div class="row">
        <div class="invoice-to">
          <ul>
            <li>
              <h3>Invoice To: </h3>
            </li>
            <li>
              <p>{{ $order->user ? $order->user->name : 'N/A' }}</p>
            </li>
            <li>
              <p>{{ ($order->user && $order->user->userDetail) ? $order->user->userDetail->phone : 'N/A' }}</p>
            </li>

            <li>
              @if($order->user && $order->user->userDetail)
              <p>{{ $order->city($order->user->userDetail->city_id) }}, {{
                $order->state($order->user->userDetail->state_id) }}</p>
              @else
              N/A
              @endif
            </li>

            <li>
              @if($order->user && $order->user->userDetail)
              <p>{{ $order->user->userDetail->address }}, {{ $order->user->userDetail->postal_code }}</p>
              @else
              N/A
              @endif
            </li>
          </ul>
        </div>
        <div class="invoce-no">
          <ul>
            <li>
              <h3>Invoice No: #{{ $order->id }}</h3>
            </li>
            <li>
              <p>Date: {{ date('d F, Y', strtotime($order->created_at))}}</p>
            </li>
            <li>
              @php
              $payment_method = $order->payment_method == 'COD' ? 'Cash on delivery' : 'Online'
              @endphp
              <p>Payment Method: {{ $order->payment_method }}</p>
            </li>
            <li>
              <p>Payment Status: {{ $order->is_paid }}</p>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <table class="table">
              <thead class="table-dark">
                <th>#</th>
                <th style="text-align: left;">Product Name</th>
                <th style="text-align: center;">Size</th>
                <th style="text-align: center;">Color</th>
                <th style="text-align: center;">Unit Price</th>
                <th style="text-align: center;">Quantity</th>
                <th style="text-align: center;">Total</th>
              </thead>
              <tbody class="table-light">
                @php
                $subtotal = 0
                @endphp
                @foreach($order->order_details as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td style="text-align: left;">{{ $item->product->name }}</td>
                  <td>{{ $item->size }}</td>
                  <td>{{ $item->color }}</td>
                  <td>{{ number_format($item->unit_price, 2) }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                </tr>
                @php
                $subtotal += ($item->unit_price * $item->quantity)
                @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <table class="calculation">
            <tr>
              <td style="width:180px; text-align: left;">
                <h4>Subtotal</h4>
              </td>
              <td>
                <h4>SA {{ number_format($subtotal, 2) }}</h4>
              </td>
            </tr>
            <tr>
              <td style="width:180px; text-align: left;">Shipping Cost</td>
              <td><span>SA {{ number_format($order->shipping_cost, 2) }}</span></td>
            </tr>
            @php
            $discount = $order->coupon_discount_amount ?? 0
            @endphp
            @if($discount != 0)
            <tr>
              <td style="width:180px; text-align: left;">Discount Amount</td>
              <td><span>SA {{ number_format($discount, 2) }}</span></td>
            </tr>
            @endif

            <tr>
              <td style="width:180px; text-align: left;">Tax ({{ $tax }}%)</td>
              <td><span>{{ number_format($order->tax, 2) }}</span></td>
            </tr>
            <tr>
              <td style="width:180px; text-align: left;">
                <h3>Total</h3>
              </td>
              <td>
                <h3>SA {{ number_format(($order->amount + $order->shipping_cost + $order->tax) - $discount, 2) }}</h3>
              </td>
            </tr>
          </table>
        </div>
        <div class="row">
          <a class="btn-success" href="{{ url('/') }}">Back Home</a>
        </div>
      </div>
    </section>
  </main>

</body>

</html>