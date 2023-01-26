<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public $from;
  public $to;

  public function __construct($from, $to)
  {
    $this->from = $from;
    $this->to = $to;
  }

  public function view(): View
  {

    if (auth()->user()->role == "Seller") {
      $seller_products_id = auth()->user()->product->pluck('id');
      $orders_id = array_unique(OrderDetails::whereIn('product_id', $seller_products_id)->pluck('order_id')->toArray());
      $sql = Order::whereBetween('created_at', [$this->from, $this->to])->whereIn('id', $orders_id);
      $order = $sql->get();
      return view('exports.seller_order', [
        'orders' => $order,
      ]);
    } elseif (auth()->user()->role == "Customer") {
      $sql = Order::whereBetween('created_at', [$this->from, $this->to])->where('user_id', auth()->id());
      $order = $sql->get();
      return view('exports.orders', [
        'orders' => $order,
      ]);
    } else {
      $sql = Order::whereBetween('created_at', [$this->from, $this->to]);

      $order = $sql->get();
      return view('exports.orders', [
        'orders' => $order,
      ]);
    }
  }
}
