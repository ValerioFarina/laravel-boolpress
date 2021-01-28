<?php

use Illuminate\Database\Seeder;

use App\Post;

use App\Category;

use Faker\Generator as Faker;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all();
        $category_ids = [];
        foreach ($categories as $category) {
            $category_ids[] = $category->id;
        }

        for ($i = 0; $i < 15; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $new_post->slug = getSlug($new_post->title, 'Post');
            $new_post->author = $faker->name();
            $new_post->content = $faker->text(500);
            $new_post->category_id = $category_ids[array_rand($category_ids)];
            $new_post->save();
        }
    }
}
