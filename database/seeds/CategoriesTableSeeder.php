<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i = 0; $i < 5; $i++) {
             $new_category = new Category();
             $new_category->name = $faker->words(3, true);
             $new_category->slug = getSlug($new_category->name, 'Category');
             $new_category->save();
         }
     }
}
