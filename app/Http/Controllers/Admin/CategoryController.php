<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::all()
        ];
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name' => 'required|max:255',
        ]);
        $data = $request->all();
        // we generate a slug based on the name of the selected category
        $data["slug"] = getSlug($data["name"], 'Category');
        $new_category = new Category();
        $new_category->fill($data);
        $new_category->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $data = [
                'category' => $category
            ];
            return view('admin.categories.show', $data);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $data = [
                'category' => $category
            ];
            return view('admin.categories.edit', $data);
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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $data = $request->all();

        if (strtolower($data["name"]) != strtolower($category->name)) {
            // if the name of the category has been changed, we generate a new slug
            $data["slug"] = getSlug($data["name"], 'Category');
            // and then we update both the name and the slug of the category
            $category->update($data);
        } elseif ($data["name"] != $category->name) {
            // if the name of the category has been changed only with respect to its font case (e.g. from "hello" to "HELLO")
            // we update the name of the category, but not its slug
            $category->update($data);
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
