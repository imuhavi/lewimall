<?php

namespace Database\Seeders;

use App\Models\SubscriptionOption;
use Illuminate\Database\Seeder;

class SubscriptionOptionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    SubscriptionOption::create([
      'subscription_id' => 1,
      'option' => 'Marketing'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 1,
      'option' => 'Storage'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 1,
      'option' => 'Packaging'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 1,
      'option' => 'Shipping'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 2,
      'option' => '1 Months free'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 2,
      'option' => 'Marketing'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 2,
      'option' => 'Storage'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 2,
      'option' => 'Packaging'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 2,
      'option' => 'Shipping'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 3,
      'option' => '3 Months Free'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 3,
      'option' => 'Marketing'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 3,
      'option' => 'Storage'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 3,
      'option' => 'Packaging'
    ]);
    SubscriptionOption::create([
      'subscription_id' => 3,
      'option' => 'Shipping'
    ]);
  }
}
