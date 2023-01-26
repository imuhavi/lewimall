<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
  private $VIEW_PATH = 'backend.settings.';

  public function settings(Request $request)
  {
    $data = GeneralSetting::first();
    return view($this->VIEW_PATH . 'index', compact('data'));
  }

  public function update(Request $request)
  {
    $request->validate([
      'app_name' => 'required|min:2|max:40'
    ]);


    try {
      $data = GeneralSetting::first();

      if ($data->app_name !== $request->app_name) {
        $data->app_name = $request->app_name;
      }
      if (env('app_name') !== $data->app_name) {
        set_env('app_name', str_replace(' ', '-', $request->app_name));
      }

      if ($request->file('app_logo_white')) {
        if (hasFile($data->app_logo_white)) {
          removeImage($data->app_logo_white);
        }
        uploadImage($request->file('app_logo_white'));
        $data->app_logo_white = session('fileName');
      }

      if ($request->file('app_logo_black')) {
        if (hasFile($data->app_logo_black)) {
          removeImage($data->app_logo_black);
        }
        uploadImage($request->file('app_logo_black'));
        $data->app_logo_black = session('fileName');
      }

      $data->app_email = $request->app_email ?? $data->app_email;
      $data->app_phone = $request->app_phone ?? $data->app_phone;
      $data->shipping_cost = $request->shipping_cost ?? $data->shipping_cost;
      $data->shipping_days = $request->shipping_days ?? $data->shipping_days;
      $data->tax = $request->tax ?? $data->tax;
      $data->app_address = $request->app_address ?? $data->app_address;
      $data->app_copyright_text = $request->app_copyright_text ?? $data->app_copyright_text;
      $data->save();

      return redirect()->back()->with('success', 'Website information updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function seoUpdate(Request $request)
  {
    $request->validate([
      'seo_title' => 'required',
      'seo_description' => 'required',
      'seo_keywords' => 'required'
    ]);
    try {
      GeneralSetting::first()->update([
        'seo_title' => $request->seo_title,
        'seo_description' => $request->seo_description,
        'seo_keywords' => $request->seo_keywords
      ]);
      return redirect()->back()->with('success', 'Seo meta data updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function mailUpdate(Request $request)
  {
    $request->validate([
      'mail_type' => 'required',
      'mail_host' => 'required',
      'mail_port' => 'required',
      'mail_username' => 'required',
      'mail_password' => 'required',
      'mail_encryption' => 'required',
      'mail_address' => 'required',
      'mail_from_name' => 'required'
    ]);
    try {
      $data = GeneralSetting::first();

      if (env('mail_mailer') !== $request->mail_type) {
        set_env('mail_mailer', strtolower($request->mail_type));
        $data->mail_type = strtolower($request->mail_type);
      }
      if (env('mail_host') !== $request->mail_host) {
        set_env('mail_host', strtolower($request->mail_host));
        $data->mail_host = strtolower($request->mail_host);
      }
      if (env('mail_port') !== $request->mail_port) {
        set_env('mail_port', $request->mail_port);
        $data->mail_port = $request->mail_port;
      }
      if (env('mail_username') !== $request->mail_username) {
        set_env('mail_username', $request->mail_username);
        $data->mail_username = $request->mail_username;
      }
      if (env('mail_password') !== $request->mail_password) {
        set_env('mail_password', $request->mail_password);
        $data->mail_password = $request->mail_password;
      }
      if (env('mail_encryption') !== $request->mail_encryption) {
        set_env('mail_encryption', strtolower($request->mail_encryption));
        $data->mail_encryption = strtolower($request->mail_encryption);
      }
      if (env('mail_from_address') !== $request->mail_address) {
        set_env('mail_from_address', strtolower($request->mail_address));
        $data->mail_address = strtolower($request->mail_address);
      }
      if (env('mail_from_name') !== $request->mail_from_name) {
        set_env('mail_from_name', strtolower($request->mail_from_name));
        $data->mail_from_name = strtolower($request->mail_from_name);
      }
      $data->save();

      return redirect()->back()->with('success', 'mail config updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function updatePayment(Request $request)
  {
    $request->validate([
      'myfatoorah_token' => 'required'
    ]);

    try {
      if (env('MYFATOORAH_TOKEN')) {
        set_env('MYFATOORAH_TOKEN', $request->myfatoorah_token);
      }
      return redirect()->back()->with('success', 'Myfatoorah token updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }

  public function socialUpdate(Request $request)
  {
    $request->validate([
      'app_id' => 'required',
      'app_secret' => 'required'
    ]);

    try {
      $data = GeneralSetting::first();
      if (env('GOOGLE_CLIENT_ID') !== $request->app_id) {
        set_env('GOOGLE_CLIENT_ID', strtolower($request->app_id));
        $data->app_id = strtolower($request->app_id);
      }
      $data->save();

      if (env('GOOGLE_CLIENT_SECRET') !== $request->app_secret) {
        set_env('GOOGLE_CLIENT_SECRET', strtolower($request->app_secret));
        $data->app_secret = strtolower($request->app_secret);
      }
      $data->save();
      return redirect()->back()->with('success', 'Social login config updated successfully !');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }
}
