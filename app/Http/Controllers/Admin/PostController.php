<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::select('id', 'title', 'author', 'slug')->get()
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:50',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:512'
        ]);
        $data = $request->all();
        // we generate a slug based on the post's title
        $data["slug"] = getSlug($data["title"], 'Post');
        if (array_key_exists('image', $data)) {
            $poster_path = Storage::put('post_covers', $data["image"]);
            $data['poster_path'] = $poster_path;
        }
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        if (array_key_exists('tags', $data)) {
            // if some tags have been checked, we associate these tags with the newly generated post
            $new_post->tags()->sync($data["tags"]);
        }
        return redirect()->route('admin.posts.show', ['post' => $new_post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($slug) {
         $post = Post::where('slug', $slug)->first();

         if ($post) {
             $data = [
                 'post' => $post
             ];
             return view('admin.posts.show', $data);
         }

         abort(404);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($slug) {
         $post = Post::where('slug', $slug)->first();

         if ($post) {
             $data = [
                 'post' => $post,
                 'categories' => Category::all(),
                 'tags' => Tag::all()
             ];
             return view('admin.posts.edit', $data);
         }

         abort(404);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:50',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:512'
        ]);
        $data = $request->all();

        if (strtolower($data["title"]) != strtolower($post->title)) {
            // if the post's title has been changed, we generate a new slug for the post
            $data["slug"] = getSlug($data["title"], 'Post');
        }

        if (array_key_exists('image', $data)) {
            $poster_path = Storage::put('post_covers', $data["image"]);
            $data['poster_path'] = $poster_path;
        }

        $post->update($data);
        if (!array_key_exists('tags', $data)) {
            // if all the tags have been unchecked, we put the tags' array equal to an empty array
            $data["tags"] = [];
        }
        $post->tags()->sync($data["tags"]);
        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
