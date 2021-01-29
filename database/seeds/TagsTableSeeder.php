<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i = 0; $i < 5; $i++) {
             $new_tag = new Tag();
             $new_tag->name = $faker->words(2, true);
             $new_tag->slug = getSlug($new_tag->name, 'Tag');
             $new_tag->save();
         }
     }
}
