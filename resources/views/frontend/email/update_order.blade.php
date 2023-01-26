<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update order</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="hedaer">
        <h3>Update order</h3>
      </div>
    </div>
  </header>

  <main>
    <h3>Invoice No: #{{ $order->id }}</h3>
    Your order is <i><b>{{ $order->status }}</b></i>
  </main>

</body>

</html>