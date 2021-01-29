<?php

use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

function slugExists($slug, $model) {
    switch ($model) {
        case 'Post':
            $result = Post::where('slug', $slug)->first();
            break;

        case 'Category':
            $result = Category::where('slug', $slug)->first();
            break;

        case 'Tag':
            $result = Tag::where('slug', $slug)->first();
            break;
    }
    return $result;
}

function getSlug($string, $model) {
    $slug = Str::slug($string, '-');
    $new_slug = $slug;
    $slug_found = slugExists($new_slug, $model);
    $counter = 1;
    while ($slug_found) {
        $new_slug = $slug . '-' . $counter;
        $counter++;
        $slug_found = slugExists($new_slug, $model);
    }
    return $new_slug;
}
