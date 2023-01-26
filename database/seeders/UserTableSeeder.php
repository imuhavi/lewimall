<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  { 
    User::create([
      'name' => 'Farish Ahmmed',
      'email' => '5dots.sa@gmail.com',
      'phone' => '0534588012',
      'email_verified_at' => now(),
      'role' => 'Admin',
      'password' => bcrypt('5dots.sa@gmail.com')
    ]);
  }
}
