<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Category::create([
      'name' => 'Default category',
      'slug' => 'default_category',
      'meta_title' => 'Default category',
      'meta_description' => 'Default description',
      'type' => 'Default'
    ]);
  }
}
