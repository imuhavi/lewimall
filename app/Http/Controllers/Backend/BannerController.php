<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class BannerController extends Controller
{
  private $VIEW_PATH = 'backend.banner.';
  public function banner()
  {
    $banner_one = Banner::where('position', 'one')->first();
    $bannerTwo = Banner::where('position', 'two')->first();
    $bannerThree = Banner::where('position', 'three')->first();
    $category = Category::get();
    return view($this->VIEW_PATH . 'index', compact('banner_one', 'bannerTwo', 'bannerThree', 'category'));
  }

  public function bannerOne(Request $request)
  {

    $banner_one = Banner::where('position', 'one')->first();

    $request->validate([
      'title' => 'required|max:199',
      'category_id' => 'required'
    ]);

    if ($request->file('bannerOne')) {
      if (hasFile($banner_one->banner)) {
        removeImage($banner_one->banner);
      }
      uploadImage($request->file('bannerOne'), 1024);
    }

    if ($request->status == 'on') {
      $banner_one->status = 'Active';
    } else {
      $banner_one->status = 'Inactive';
    }

    $banner_one->update([
      'title' => $request->title ?? $banner_one->title,
      'category_id' => $request->category_id,
      'banner' => session('fileName') ?? $banner_one->banner
    ]);
    return redirect()->back()->with('success', 'Banner updated successfully.');
  }

  public function bannerTwo(Request $request)
  {

    $banner_two = Banner::where('position', 'two')->first();

    $request->validate([
      'title' => 'required|max:199',
      'category_id' => 'required'
    ]);

    if ($request->file('bannerTwo')) {
      if (hasFile($banner_two->banner)) {
        removeImage($banner_two->banner);
      }
      uploadImage($request->file('bannerTwo'), 1024);
    }

    if ($request->status == 'on') {
      $banner_two->status = 'Active';
    } else {
      $banner_two->status = 'Inactive';
    }

    $banner_two->update([
      'title' => $request->title ?? $banner_two->title,
      'category_id' => $request->category_id,
      'banner' => session('fileName') ?? $banner_two->banner
    ]);
    return redirect()->back()->with('success', 'Banner updated successfully.');
  }

  public function bannerThree(Request $request)
  {

    $banner_Three = Banner::where('position', 'three')->first();

    $request->validate([
      'title' => 'required|max:199',
      'category_id' => 'required'
    ]);

    if ($request->file('bannerThree')) {
      if (hasFile($banner_Three->banner)) {
        removeImage($banner_Three->banner);
      }
      uploadImage($request->file('bannerThree'), 1024);
    }

    if ($request->status == 'on') {
      $banner_Three->status = 'Active';
    } else {
      $banner_Three->status = 'Inactive';
    }

    $banner_Three->update([
      'title' => $request->title ?? $banner_Three->title,
      'category_id' => $request->category_id,
      'banner' => session('fileName') ?? $banner_Three->banner
    ]);
    return redirect()->back()->with('success', 'Banner updated successfully.');
  }
}
