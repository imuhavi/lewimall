<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
  private $VIEW_PATH = 'backend.subcategory.index';
  private $VIEW_ROUTE = '/subcategory';

  public function index()
  {
    $page = 'index';
    $data = Subcategory::orderBy('created_at', 'DESC')->get();
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function create()
  {
    $data = '';
    $page = 'create';
    $category = Category::where('id', '!=', 1)->orderBy('name', 'asc')->get();
    return view($this->VIEW_PATH, compact('data', 'page', 'category'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:100',
      'category_id' => 'required',
      'icon' => 'required|mimes:jpg,jpeg,bmp,png',
      'slug' => 'required|max:100|unique:subcategories',
      'meta_title' => 'required|max:100',
      'meta_description' => 'required|max:1000'
    ]);

    try {
      if (isset($request->status) && $request->status == 'on') {
        $status = 'Active';
      } else {
        $status = 'Inactive';
      };

      $subcategory = new Subcategory;
      $subcategory->name = $request->name;
      $subcategory->category_id = $request->category_id;

      if ($request->file('icon')) {
        uploadImage($request->file('icon'), 281);
        $subcategory->icon = session('fileName');
      }

      if ($request->file('banner')) {
        uploadImage($request->file('banner'), 1024);
        $subcategory->banner = session('fileName');
      }

      $subcategory->slug = strtolower($request->slug);
      $subcategory->status = $status;
      $subcategory->meta_title = $request->meta_title;
      $subcategory->meta_description = $request->meta_description;
      $subcategory->save();
      return back()->with('success', 'Subategory saved successfully .');
    } catch (\Throwable $th) {
      return back()->with('error', $th->getMessage());
    };
  }

  public function show(Subcategory $subcategory)
  {
    $page = 'show';
    $data = $subcategory;
    return view($this->VIEW_PATH, compact('data', 'page'));
  }

  public function edit(Subcategory $subcategory)
  {
    $page = 'edit';
    $data = $subcategory;
    $category = Category::orderBy('name', 'asc')->get();
    return view($this->VIEW_PATH, compact('page', 'data', 'category'));
  }

  public function update(Request $request, Subcategory $subcategory)
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
        removeImage($subcategory->icon);
        uploadImage($request->file('icon'), 281);
        $subcategory->icon = session('fileName');
      }

      if ($request->file('banner')) {
        removeImage($subcategory->banner);
        uploadImage($request->file('banner'), 1024);
        $subcategory->banner = session('fileName');
      }

      $subcategory->name = $request->name;
      $subcategory->slug = strtolower($request->slug);
      if ($status) {
        $subcategory->status = $status;
      }

      $subcategory->category_id = $request->category_id;
      $subcategory->meta_title = $request->meta_title;
      $subcategory->meta_description = $request->meta_description;
      $subcategory->save();
      return redirect(routePrefix() . $this->VIEW_ROUTE)->with('success', 'Subcategory updated successfully.');
    } catch (\Throwable $th) {
      return back()->with('error', $th->getMessage());
    }
  }

  public function destroy(Subcategory $subcategory)
  {
    try {

      if (hasFile($subcategory->icon)) {
        removeImage($subcategory->icon);
      }

      if (hasFile($subcategory->banner)) {
        removeImage($subcategory->banner);
      }
      $subcategory->delete();
      return redirect()->back()->with('success', 'Subcategory deleted successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }
}
