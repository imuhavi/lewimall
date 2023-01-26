<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
  private $VIEW_PATH = 'backend.attributes.index';
  private $VIEW_ROUTE = '/attributes';

  public function index()
  {
    $page = 'index';
    $data = Attribute::orderBy('created_at', 'desc')->get();
    return view($this->VIEW_PATH, compact('page', 'data'));
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
      'attribute_value' => 'required'
    ]);

    try {
      Attribute::create([
        'name' => $request->name,
        'value' => json_encode($request->attribute_value)
      ]);
      return back()->with('success', 'Attribute saved successfully .');
    } catch (\Throwable $th) {
      return back()->with('error', $th->getMessage());
    }
  }

  public function show($id)
  {
    //
  }

  public function edit(Attribute $attribute)
  {
    $page = 'edit';
    $data = $attribute;
    $values = '';
    $last_key = count(json_decode($attribute->value)) - 1;
    foreach (json_decode($attribute->value) as $key => $item) {
      $values .= $item;
      if ($key !== $last_key) {
        $values .= ', ';
      }
    }
    $data->value = $values;
    return view($this->VIEW_PATH, compact('page', 'data'));
  }

  public function update(Request $request, Attribute $attribute)
  {
    $request->validate([
      'name' => 'required|max:100',
      'attribute_value' => 'required'
    ]);

    try {
      $attribute->update([
        'name' => ucwords($request->name),
        'value' => json_encode(explode(',', str_replace(' ', '', ucwords($request->attribute_value))))
      ]);
      return redirect(routePrefix() . $this->VIEW_ROUTE)->with('success', 'Attribute Updated successfully .');
    } catch (\Throwable $th) {
      return back()->with('error', $th->getMessage());
    }
  }

  public function destroy($id)
  {
    try {
      Attribute::destroy($id);
      return back()->with('success', 'Attribute deleted successfully!');
    } catch (\Throwable $th) {
      return back()->with('error', $th->getMessage());
    }
  }
}
