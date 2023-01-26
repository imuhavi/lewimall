<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialConfig;
use Illuminate\Http\Request;

class SocialConfigController extends Controller
{
  // public function update(Request $request)
  // {
  //     $request->validate([
  //         'app_id' => 'required',
  //         'app_secret' => 'required'
  //     ]);
  //     try {
  //         if($request->type){
  //             SocialConfig::where('type', $request->type)->first()->update([
  //                 'app_id' => $request->app_id,
  //                 'app_secret' => $request->app_secret
  //             ]);
  //             return redirect()->back()->with('success', 'Social config updated successfully !');
  //         }
  //         return redirect()->back()->with('warning', 'Something went wrong !');
  //     } catch (\Throwable $th) {
  //         return redirect()->back()->with('error', $th->getMessage());
  //     }
  // }
}
