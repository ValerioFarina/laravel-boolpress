<?php

use Illuminate\Database\Seeder;

use App\Post;

use Faker\Generator as Faker;

use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $slug = Str::slug($new_post->title, '-');
            $new_slug = $slug;
            $slug_found = Post::where('slug', $new_slug)->first();
            $counter = 1;
            while ($slug_found) {
                $new_slug = $slug . '-' . $counter;
                $counter++;
                $slug_found = Post::where('slug', $new_slug)->first();
            }
            $new_post->slug = $new_slug;
            $new_post->author = $faker->name();
            $new_post->content = $faker->text(500);
            $new_post->save();
        }
    }
}
