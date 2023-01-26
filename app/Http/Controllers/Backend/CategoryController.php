<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  private $VIEW_PATH = 'backend.category.index';
  private $VIEW_ROUTE = '/category';

  public function index()
  {
    $page = 'index';
    $data = Category::where('id', '!=', 1)->orderBy('created_at', 'DESC')->get();
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function create()
  {
    $data = '';
    $page = 'create';
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:100',
      'banner' => 'required|mimes:jpg,jpeg,bmp,png',
      'slug' => 'required|max:100|unique:categories',
      'meta_title' => 'required|max:100',
      'meta_description' => 'required|max:1000'
    ]);

    try {
      if (isset($request->status) && $request->status == 'on') {
        $status = 'Active';
      } else {
        $status = 'Inactive';
      }

      $category = new Category();
      $category->name = $request->name;

      if ($request->file('icon')) {
        uploadImage($request->file('icon'), 100);
        $category->icon = session('fileName');
      }

      if ($request->file('banner')) {
        uploadImage($request->file('banner'), 586);
        $category->banner = session('fileName');
      }

      $category->slug = strtolower($request->slug);
      $category->status = $status;
      $category->meta_title = $request->meta_title;
      $category->meta_description = $request->meta_description;
      $category->save();
      return back()->with('success', 'Category saved successfully .');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function show(Category $category)
  {
    $page = 'show';
    $data = $category;
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function edit(Category $category)
  {
    $page = 'edit';
    $data = $category;
    return view($this->VIEW_PATH, compact('page', 'data'));
  }

  public function update(Request $request, Category $category)
  {
    $request->validate([
      'name' => 'required|max:100',
      'slug' => 'required|max:100',
      'meta_title' => 'required|max:100',
      'meta_description' => 'required|max:1000'
    ]);

    try {
      if (isset($request->status) && $request->status == 'on') {
        $status = 'Active';
      } else {
        $status = 'Inactive';
      }

      if ($request->file('icon')) {
        removeImage($category->icon);
        uploadImage($request->file('icon'), 100);
        $category->icon = session('fileName');
      }

      if ($request->file('banner')) {
        removeImage($category->banner);
        uploadImage($request->file('banner'), 586);
        $category->banner = session('fileName');
      }

      $category->name = $request->name;
      $category->slug = strtolower($request->slug);
      if ($status) {
        $category->status = $status;
      }
      $category->meta_title = $request->meta_title;
      $category->meta_description = $request->meta_description;
      $category->save();
      return redirect(routePrefix() . $this->VIEW_ROUTE)->with('success', 'Category updated successfully .');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function destroy(Category $category)
  {
    try {
      if ($category->type === 'Default') {
        return redirect()->back()->with('warning', 'You can not delete this default category.');
      }

      if (hasFile($category->icon)) {
        removeImage($category->icon);
      }

      if (hasFile($category->banner)) {
        removeImage($category->banner);
      }

      $category->delete();
      return redirect()->back()->with('success', 'Category deleted successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }
}
