<?php

use Illuminate\Support\Str;
use App\Post;

function getPostSlug($post_title) {
    $slug = Str::slug($post_title, '-');
    $new_slug = $slug;
    $slug_found = Post::where('slug', $new_slug)->first();
    $counter = 1;
    while ($slug_found) {
        $new_slug = $slug . '-' . $counter;
        $counter++;
        $slug_found = Post::where('slug', $new_slug)->first();
    }
    return $new_slug;
}
