<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CouponController extends Controller
{

  private $VIEW_PATH = "backend.coupon.index";

  public function index()
  {
    $page = 'index';
    $data = Coupon::orderBy('created_at', 'DESC')->get();
    return view($this->VIEW_PATH, compact('page', 'data'));
  }

  public function create()
  {
    $data = '';
    $page = 'create';
    $categories = Category::whereStatus('Active')->get(['id', 'name'])->toArray();
    $subCategories = Subcategory::whereStatus('Active')->get(['id', 'name'])->toArray();
    $products = Product::whereStatus('Active')->get(['id', 'name']);
    return view($this->VIEW_PATH, compact('data', 'page', 'categories', 'subCategories', 'products'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'code' => 'required',
      'discount' => 'required',
      'discount_type' => 'required',
      'max_discount_amount' => 'required',
      'min_shopping_amount' => 'required',
      'type' => 'required',
      'start' => 'required',
      'end' => 'required'
    ]);

    $data = $request->except('_token', 'category_ids', 'product_ids');

    if ($request->type == 'Category') {
      $request->validate([
        'category_ids' => 'required'
      ]);
      $data['category_ids'] = json_encode($request->category_ids);
    } elseif ($request->type == 'Product') {
      $request->validate([
        'product_ids' => 'required'
      ]);
      $data['product_ids'] = json_encode($request->product_ids);
    }

    $data['code'] = strtolower($request->code);

    Coupon::create($data);

    return redirect()->back()->with('success', 'Coupon added successfully.');
  }

  public function show(Coupon $coupon)
  {
    $data = $coupon;
    $page = 'show';
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function edit(Coupon $coupon)
  {
    $data = $coupon;
    $page = 'edit';
    $categories = Category::whereStatus('Active')->get(['id', 'name'])->toArray();
    $subCategories = Subcategory::whereStatus('Active')->get(['id', 'name'])->toArray();
    $products = Product::whereStatus('Active')->get(['id', 'name']);
    return view($this->VIEW_PATH, compact('data', 'page', 'categories', 'subCategories', 'products'));
  }

  public function update(Request $request, Coupon $coupon)
  {
    $request->validate([
      'name' => 'required',
      'code' => 'required',
      'discount' => 'required',
      'discount_type' => 'required',
      'max_discount_amount' => 'required',
      'min_shopping_amount' => 'required',
      'type' => 'required',
      'start' => 'required',
      'end' => 'required'
    ]);

    $data = $request->except('_token', 'category_ids', 'product_ids');

    if ($request->type == 'Category') {
      $request->validate([
        'category_ids' => 'required'
      ]);
      $data['category_ids'] = json_encode($request->category_ids);
      $data['product_ids'] = null;
    } elseif ($request->type == 'Product') {
      $request->validate([
        'product_ids' => 'required'
      ]);
      $data['product_ids'] = json_encode($request->product_ids);
      $data['category_ids'] = null;
    } else {
      $data['category_ids'] = null;
      $data['product_ids'] = null;
    }

    $data['code'] = strtolower($request->code);

    $coupon->update($data);

    return redirect()->back()->with('success', 'Coupon updated successfully.');
  }

  public function destroy(Coupon $coupon)
  {
    $coupon->delete();
    return redirect()->back()->with('success', 'Coupon deleted successfully !');
  }
}
