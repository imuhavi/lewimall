<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
  private $VIEW = 'backend.slider.';
  private $URL = 'admin/sliders';

  public function index(Request $request)
  {
    $data = Slider::with('category')->orderBy('updated_at', 'desc')->get();
    return view($this->VIEW . 'index', compact('data'));
  }

  public function create()
  {
    $category = Category::whereStatus('Active')->get();
    return view($this->VIEW . 'create', compact('category'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:199',
      'banner' => 'required',
      'category_id' => 'required'
    ]);
    if ($request->file('banner')) {
      uploadImage($request->file('banner'), 1024);
    }

    Slider::create([
      'title' => $request->title,
      'sub_title' => $request->sub_title,
      'category_id' => $request->category_id,
      'banner' => session('fileName'),
      'status' => 'Active'
    ]);
    return redirect($this->URL)->with('success', 'Slider added successfully.');
  }

  public function edit(Slider $slider)
  {
    $category = Category::whereStatus('Active')->get();
    return view($this->VIEW . 'edit', compact('category', 'slider'));
  }

  public function update(Request $request, Slider $slider)
  {
    $request->validate([
      'category_id' => 'required'
    ]);
    if ($request->file('banner')) {
      if (hasFile($slider->banner)) {
        removeImage($slider->banner);
        uploadImage($request->file('banner'), 1024);
      }
    }
    $slider->update([
      'title' => $request->title ?? $slider->title,
      'sub_title' => $request->sub_title ?? $slider->sub_title,
      'category_id' => $request->category_id,
      'banner' => session('fileName') ?? $slider->banner
    ]);
    return redirect($this->URL)->with('success', 'Slider updated successfully.');
  }

  public function destroy(Slider $slider)
  {
    $slider->delete();
    return redirect($this->URL)->with('success', 'Slider deleted successfully.');
  }

  public function statusChange(Slider $slider)
  {
    if ($slider->status == 'Active') {
      $slider->update([
        'status' => 'Inactive'
      ]);
    } else {
      $slider->update([
        'status' => 'Active'
      ]);
    }
    return redirect($this->URL)->with('success', 'Slider status updated successfully.');
  }
}
