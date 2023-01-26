<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\User;
use App\Notifications\NotifyCreateProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  private $VIEW_PATH = 'backend.products.index';

  public function index(Request $request)
  {
    $page = 'index';
    $sql = Product::with('user')->where('is_draft', 0)->orderBy('created_at', 'DESC');

    $keyword = '';
    if ($request->keyword) {
      $keyword = $request->keyword;
      $sql->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('product_sku', 'like', '%' . $keyword . '%')
        ->orWhere('slug', 'like', '%' . $keyword . '%')
        ->orWhere('purchase_price', 'like', '%' . $keyword . '%')
        ->orWhere('price', 'like', '%' . $keyword . '%')
        ->orWhere('discount_type', 'like', '%' . $keyword . '%')
        ->orWhere('discount', 'like', '%' . $keyword . '%')
        ->orWhere('unit', 'like', '%' . $keyword . '%');
    }

    if (auth()->user()->role == 'Seller') {
      $sql->where('user_id', auth()->id());
    }


    $data = $sql->paginate(10);
    return view($this->VIEW_PATH, compact('page', 'data', 'keyword'));
  }



  public function create()
  {
    $data = '';
    $page = 'create';
    $category = Category::where('id', '!=', 1)->orderBy('name', 'asc')->get();

    $subCategory = Subcategory::orderBy('name', 'asc')->get();
    // $brand = Brand::orderBy('name', 'asc')->get();
    $sellers = User::where('role', 'Seller')->orderBy('name', 'asc')->get();
    $attributes = Attribute::orderBy('name', 'asc')->get();

    return view($this->VIEW_PATH, compact('data', 'page', 'category', 'subCategory', 'sellers', 'attributes'));
  }


  public function getSubcategory($id)
  {
    $subcategorires = Subcategory::where('category_id', $id)->get();
    // return $subcategorires;
    return response()->json($subcategorires);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:199',
      'slug' => 'required|max:199|unique:products',
      'product_sku' => 'required|unique:products',
      'purchase_price' => 'required',
      'price' => 'required',
      'thumbnail' => 'required',
      'images' => 'required',
      'unit' => 'required',
      'min' => 'required',
      'max' => 'required',
      'quantity' => 'required',
      'category_id' => 'required',
      'sub_category_id' => 'required'
    ]);


    try {
      $data = $request->except(['_token', 'images', 'category_id', 'sub_category_id']);


      if (!empty($data['attributes'])) {
        $data['attributes'] = json_encode(array_map(function ($item) {
          return json_encode(explode('-', $item));
        }, $data['attributes']));
      }

      if ($request->status == 'on') {
        $data['status'] = 'Active';
      } else {
        $data['status'] = 'Inactive';
      }

      if ($request->is_draft == 'on') {
        $data['is_draft'] = 1;
      } else {
        $data['is_draft'] = 0;
      }
      if ($request->isCashAvailable == 'on') {
        $data['isCashAvailable'] = 1;
      } else {
        $data['isCashAvailable'] = 0;
      }

      if ($request->file('meta_image')) {
        uploadImage($request->file('meta_image'));
        $data['meta_image'] = session('fileName');
      }
      if ($request->file('pdf')) {
        uploadImage($request->file('pdf'));
        $data['pdf'] = session('fileName');
      }
      if ($request->file('thumbnail')) {
        uploadImage($request->file('thumbnail'), 500);
        $data['thumbnail'] = session('fileName');
      }


      $product = Product::create($data);

      foreach ($request->category_id as $item) {
        ProductCategory::create([
          'product_id' => $product->id,
          'category_subcategory_id' => $item
        ]);
      }

      foreach ($request->sub_category_id as $item) {
        ProductCategory::create([
          'product_id' => $product->id,
          'category_subcategory_id' => $item,
          'category_or_subcategory' => 'subcategory'
        ]);
      }

      if (!empty($request->images)) {
        foreach ($request->images as $image) {
          uploadImage($image, 500);
          ProductImage::create([
            'product_id' => $product->id,
            'image' => session('fileName')
          ]);
        }
      }

      $admin = User::where('role', 'Admin')->first();
      $admin->notify(new NotifyCreateProduct($product));

      return redirect()->back()->with('success', 'Product uploaded successfully.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function show(Product $product)
  {
    $page = 'show';
    $data = $product;

    $colors = [];
    $sizes = [];

    if ($product->attributes) {
      foreach (json_decode($product->attributes) as $attribute) {
        $itemArr = json_decode($attribute);
        $item = Attribute::find($itemArr[0]);
        if ($item->name == 'Color') {
          array_push($colors, $itemArr[1]);
        } elseif ($item->name == 'Size') {
          array_push($sizes, $itemArr[1]);
        }
      }
      $colors = array_unique($colors);
      $sizes = array_unique($sizes);
    }

    return view($this->VIEW_PATH, compact('data', 'page', 'colors', 'sizes'));
  }

  public function edit(Product $product)
  {
    $page = 'edit';
    $data = $product;
    $selectProductCategory = json_decode($product->productCategory->pluck('category_subcategory_id'));
    $selectProductSubCategory = json_decode($product->productSubcatogory->pluck('category_subcategory_id'));
    $category = Category::orderBy('name', 'asc')->get();
    $subCategory = Subcategory::orderBy('name', 'asc')->get();
    $sellers = User::where('role', 'Seller')->orderBy('name', 'asc')->get();
    $attributes = Attribute::orderBy('name', 'asc')->get();
    return view($this->VIEW_PATH, compact('data', 'page', 'category', 'selectProductCategory', 'selectProductSubCategory', 'subCategory', 'sellers', 'attributes'));
  }

  public function update(Request $request, Product $product)
  {
    $request->validate([
      'name' => 'required|max:199',
      'slug' => 'required|max:199',
      'purchase_price' => 'required',
      'price' => 'required',
      'unit' => 'required',
      'min' => 'required',
      'max' => 'required',
      'quantity' => 'required'
    ]);

    try {
      $data = $request->except(['_token', 'images', 'category_id', 'sub_category_id']);

      if (!empty($data['attributes'])) {
        $data['attributes'] = json_encode(array_map(function ($item) {
          return json_encode(explode('-', $item));
        }, $data['attributes']));
      }

      if ($request->status == 'on') {

        $data['status'] = 'Active';
      } else {
        $data['status'] = 'Inactive';
      }

      if ($request->is_draft == 'on') {
        $data['is_draft'] = 1;
      } else {
        $data['is_draft'] = 0;
      }

      if ($request->isCashAvailable == 'on') {
        $data['isCashAvailable'] = 1;
      } else {
        $data['isCashAvailable'] = 0;
      }

      if ($request->file('meta_image')) {
        removeImage($product->meta_image);
        uploadImage($request->file('meta_image'), 647);
        $data['meta_image'] = session('fileName');
      }
      if ($request->file('pdf')) {
        removeImage($product->pdf);
        uploadImage($request->file('pdf'));
        $data['pdf'] = session('fileName');
      }
      if ($request->file('thumbnail')) {
        removeImage($product->thumbnail);
        uploadImage($request->file('thumbnail'), 647);
        $data['thumbnail'] = session('fileName');
      }

      $product->update($data);
      ProductCategory::destroy($product->productCategory->pluck('id'));

      foreach ($request->category_id as $item) {
        ProductCategory::Create([
          'product_id' => $product->id,
          'category_subcategory_id' => $item
        ]);
      }

      foreach ($request->sub_category_id as $item) {
        ProductCategory::Create([
          'product_id' => $product->id,
          'category_subcategory_id' => $item,
          'category_or_subcategory' => 'subcategory'
        ]);
      }

      if (!empty($request->images)) {
        foreach ($request->images as $image) {
          uploadImage($image);
          ProductImage::create([
            'product_id' => $product->id,
            'image' => session('fileName')
          ]);
        }
      }
      return redirect()->back()->with('success', 'Product updated successfully.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function destroy(Product $product)
  {
    if ($product->thumbnail) {
      removeImage($product->thumbnail);
    }
    if ($product->pdf) {
      removeImage($product->pdf);
    }
    if ($product->meta_image) {
      removeImage($product->meta_image);
    }

    foreach ($product->images as $image) {
      removeImage($image->image);
    }
    ProductCategory::destroy($product->productCategory->pluck('id'));
    $product->delete();
    return redirect()->back()->with('success', 'Product deleted successfully !');
  }

  public function destroyImage(ProductImage $image)
  {
    removeImage($image->image);
    $image->delete();
    return redirect()->back()->with('success', 'Product image deleted successfully !');
  }

  public function productDraft(Request $request)
  {
    $page = 'index';
    // $sellers = User::where('role', 'Seller')->where('id', auth()->id())->orderBy('name', 'asc')->get();
    $sql = Product::with('category', 'user')->where('is_draft', 1)->orderBy('created_at', 'DESC');

    $keyword = '';
    if ($request->keyword) {
      $keyword = $request->keyword;
      $sql->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('product_sku', 'like', '%' . $keyword . '%')
        ->orWhere('slug', 'like', '%' . $keyword . '%')
        ->orWhere('purchase_price', 'like', '%' . $keyword . '%')
        ->orWhere('price', 'like', '%' . $keyword . '%')
        ->orWhere('discount_type', 'like', '%' . $keyword . '%')
        ->orWhere('discount', 'like', '%' . $keyword . '%')
        ->orWhere('unit', 'like', '%' . $keyword . '%');
    }

    $data = $sql->paginate(2);
    return view($this->VIEW_PATH, compact('page', 'data', 'keyword'));
  }
}
