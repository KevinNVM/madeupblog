<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Posts/Categories/Index', [
            'categories' => Category::all(),
            'title' => 'Post Categories'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::where('category_id', $category->id)->latest()->paginate(10),
            'title' => "$category->name Posts"
        ]);
    }
}