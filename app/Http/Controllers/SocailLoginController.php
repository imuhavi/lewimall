<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocailLoginController extends Controller
{
  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return \Illuminate\Http\Response
   */
  public function redirectToGoogleProvider()
  {
    return Socialite::driver('google')->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleGoogleProviderCallback()
  {
    $user = Socialite::driver('google')->user();
    if (User::where('email', $user->getEmail())->where('provider_id', $user->getId())->exists()) {
      $getUser = User::where('email', $user->getEmail())->first();
      Auth::guard()->login($getUser, true);
      return redirect()->to(route('home'));
    } else {
      if (User::where('email', $user->getEmail())->exists()) {
        return redirect()->to(route('login'))->with('error', 'Email Already Register.');
      } else {
        $create_user = User::create([
          'name' => $user->getName(),
          'email' => $user->getEmail(),
          'provider_id' => $user->getId(),
          'provider' => 'google',
          'email_verified_at' => Carbon::now(),
        ]);
        Auth::login($create_user, true);
        return redirect(RouteServiceProvider::HOME);
      }
    }
  }

  // public function redirectToGithuProvider()
  // {
  //   return Socialite::driver('github')->redirect();
  // }

  // public function handleGithubProviderCallback()
  // {
  //   $user = Socialite::driver('github')->user();
  //   $currentTime = Carbon::now()->format('Y-m-d H:i:s');
  //   if (User::where('email', $user->getEmail())->where('provider_id', $user->getId())->exists()) {
  //     $getUser = User::where('email', $user->getEmail())->first();
  //     Auth::guard()->login($getUser, true);
  //     return redirect()->to(route('home'));
  //   } else {
  //     if (User::where('email', $user->getEmail())->exists()) {
  //       return redirect()->to(route('login'))->with('error', 'Email Already Register.');
  //     } else {

  //       $create_user = User::create([
  //         'name' => $user->getName(),
  //         'email' => $user->getEmail(),
  //         'provider_id' => $user->getId(),
  //         'provider' => 'github',
  //         'email_verified_at' => Carbon::now(),
  //       ]);
  //       Auth::login($create_user, true);
  //       return redirect(RouteServiceProvider::HOME);
  //     }
  //   }
  // }
}
