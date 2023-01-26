<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Subscription::create([
      'name' => 'Basic',
      'price' => '960',
      'days' => '30'
    ]);
    Subscription::create([
      'name' => 'Silver',
      'price' => '2880',
      'days' => '90'
    ]);
    Subscription::create([
      'name' => 'Gold',
      'price' => '5570',
      'days' => '180'
    ]);
  }
}