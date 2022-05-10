<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $category = Category::create([
          'title_ar' => 'Category1 ar',
          'title_en' => 'Category1 en',
          'slug'     => 'Category1 en',
          'summary'  => json_encode([
            'en'     => 'SummaryTest_en',
            'ar'     => 'SummaryTest_ar'
          ]),
          'keyword'  => 'keywords',
          'desc'     => json_encode([
            'en'     => 'Category1 Description En',
            'ar' => 'Category1 Description Ar'
          ]),
          'icon' => 'categories/default.png',
      ]);
    }
}
