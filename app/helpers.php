<?php

use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

// this function checks whether a given slug already exists in the database
// (either in the posts table, or in the categories table or in the tags table)
function slugExists($slug, $model) {
    switch ($model) {
        case 'Post':
            // if the given model is equal to "Post",
            // we check if the given slug already exists in the posts table
            $result = Post::where('slug', $slug)->first();
            break;

        case 'Category':
            // if the given model is equal to "Category",
            // we check if the given slug already exists in the categories table
            $result = Category::where('slug', $slug)->first();
            break;

        case 'Tag':
            // if the given model is equal to "Tag",
            // we check if the given slug already exists in the tags table
            $result = Tag::where('slug', $slug)->first();
            break;
    }
    return $result;
}

// this function generates a slug starting from a given string
// the given string is either the title of a post, or the name of a category, or the name of a tag
// (according to whether the given model is equal to, respectively, "Post", "Category" or "Tag")
function getSlug($string, $model) {
    // we generate the slug starting from the given string
    $slug = Str::slug($string, '-');
    // we make a copy of the slug
    $new_slug = $slug;
    // we check if the generated slug already exists in the corresponding table
    $slug_found = slugExists($new_slug, $model);
    $counter = 1;
    while ($slug_found) {
        // if the generated slug already exists in the corresponding table,
        // we modify the slug by adding a number to it at the end
        $new_slug = $slug . '-' . $counter;
        $counter++;
        // we check if the modified slug already exists in the corresponding table
        $slug_found = slugExists($new_slug, $model);
    }
    // we return a slug which certainly does not already exist in the corresponding table
    return $new_slug;
}
