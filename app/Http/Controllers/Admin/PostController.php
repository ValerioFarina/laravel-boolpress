<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Category;
use Illuminate\Support\Str;

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
            'categories' => Category::all()
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
        $data = $request->all();
        $slug = Str::slug($data["title"], '-');
        $new_slug = $slug;
        $slug_found = Post::where('slug', $new_slug)->first();
        $counter = 1;
        while ($slug_found) {
            $new_slug = $slug . '-' . $counter;
            $counter++;
            $slug_found = Post::where('slug', $new_slug)->first();
        }
        $data["slug"] = $new_slug;
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
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
                 'categories' => Category::all()
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
        $data = $request->all();
        if ($data["title"] != $post->title) {
            $slug = Str::slug($data["title"], '-');
            $new_slug = $slug;
            $slug_found = Post::where('slug', $new_slug)->first();
            $counter = 1;
            while ($slug_found) {
                $new_slug = $slug . '-' . $counter;
                $counter++;
                $slug_found = Post::where('slug', $new_slug)->first();
            }
            $data["slug"] = $new_slug;
        }
        $post->update($data);
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
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
