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
             $slug = Str::slug($new_category->name, '-');
             $new_slug = $slug;
             $slug_found = Category::where('slug', $new_slug)->first();
             $counter = 1;
             while ($slug_found) {
                 $new_slug = $slug . '-' . $counter;
                 $counter++;
                 $slug_found = Category::where('slug', $new_slug)->first();
             }
             $new_category->slug = $new_slug;
             $new_category->save();
         }
     }
}
