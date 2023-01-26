<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      CategoryTableSeeder::class,
      GeneralSettingTableSeeder::class,
      UserTableSeeder::class,
      SubscriptionTableSeeder::class,
      SubscriptionOptionTableSeeder::class,
      BannerSeeder::class,
    ]);
  }
}
