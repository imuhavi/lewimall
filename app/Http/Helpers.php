<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\SocialConfig;
use App\Models\Subcategory;
use Illuminate\Support\Str;

if (!function_exists('uploadImage')) {
  function uploadImage($image, $size = 100)
  {
    $ext = $image->getClientOriginalExtension();
    $imageFile = time() . '_' . Str::random() . '.' . $ext;
    $destination = public_path('backend/uploads');

    if ($ext == 'pdf') {
      $image->move($destination, $imageFile);
    } else {
      $imgFile = Image::make($image->getRealPath());
      $imgFile->resize($size, $size, function ($constraint) {
        $constraint->aspectRatio();
      })->save($destination . '/' . $imageFile);
    }

    return back()->with('success', 'Image has successfully uploaded.')
      ->with('fileName', $imageFile);
  }
}

if (!function_exists('removeImage')) {
  function removeImage($image)
  {
    $destination = public_path('backend/uploads/');
    unlink($destination . $image);

    return back()->with('success', 'Image has successfully removed.');
  }
}

if (!function_exists('routePrefix')) {
  function routePrefix()
  {
    return strtolower(auth()->user()->role);
  }
}

if (!function_exists('hasFile')) {
  function hasFile($file)
  {
    if (!empty($file) && file_exists(public_path('backend/uploads/' . $file))) {
      return true;
    }
    return false;
  }
}

if (!function_exists('set_env')) {
  function set_env(string $key, string $value, $env_path = null)
  {
    $value = preg_replace('/\s+/', '', $value); //replace special ch
    $key = strtoupper($key); //force upper for security
    $env = file_get_contents(isset($env_path) ? $env_path : base_path('.env')); //fet .env file
    $env = str_replace("$key=" . env($key), "$key=" . $value, $env); //replace value
    /** Save file eith new content */
    $env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
  }
}

if (!function_exists('getCategories')) {
  function getCategories()
  {
    return Category::whereType('Deleteable')->orderBy('updated_at', 'desc')->get();
  }
}

if (!function_exists('getCart')) {
  function getCart()
  {
    $data = [
      'cart' => [],
      'total' => 0
    ];
    $session = session('cart');
    if (!empty($session)) {
      foreach ($session as $key => $item) {
        $product = Product::find($item['product_id']);

        $discount = 0;
        if (!empty($product->discount_type)) {
          if ($product->discount_type == 'Percent') {
            $discount = $product->price * ($product->discount / 100);
          } elseif ($product->discount_type == 'Flat') {
            $discount = $product->discount;
          }
        }

        $data['cart'][$key] = [
          'product_id' => $product->id,
          'product_name' => $product->name,
          'product_price' => $product->price,
          'product_url' => $product->thumbnail,
          'discount' => $item['quantity'] * $discount,
          'quantity' => $item['quantity'],
          'color' => $item['color'],
          'size' => $item['size'],
          'is_cash_available' => $product->isCashAvailable
        ];
        $data['total'] += (($product->price * $item['quantity']) - ($item['quantity'] * $discount));
      }
    }
    return $data;
  }
}

if (!function_exists('social_credential')) {
  function social_credential($provider)
  {
    return SocialConfig::whereType(ucfirst($provider))->first();
  }
}


if (!function_exists('getcategory')) {
  function getcategory($category)
  {
    return Category::findOrFail($category)->name;
  }
}

if (!function_exists('getsubcategory')) {
  function getsubcategory($subcategory)
  {
    return Subcategory::findOrFail($subcategory)->name;
  }
}
