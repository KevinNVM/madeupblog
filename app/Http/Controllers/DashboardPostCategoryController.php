<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post\Category;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostCategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create new category';
        return Inertia::render('Posts/Categories/Create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) abort(404);
        $rules = [
            'name' => ['required', 'max:255'],
            'desc' => ['max:2000']
        ];

        if ($request->slug) $rules['slug'] = ['required', 'min:3', 'alpha_dash', 'lowercase', 'unique:posts'];

        $validatedData = $request->validate($rules);

        $slug = (isset($validatedData['slug']) ? $validatedData['slug'] : SlugService::createSlug(Category::class, 'slug', $validatedData['name']));
        $validatedData['slug'] = $slug;

        $newCategory = new Category($validatedData);
        $newCategory->save();
        return redirect()->route('categories.index')->with('message', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Inertia::render('Posts/Categories/Edit', [
            'category' => $category,
            'title' => "Edit Category $category->name"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (!Auth::check()) abort(404);
        $rules = [
            'name' => ['required', 'max:255'],
            'desc' => ['max:2000']
        ];

        if ($request->slug) $rules['slug'] = ['required', 'min:3', 'alpha_dash', 'lowercase', 'unique:posts'];
        elseif ($request->slug === $category->slug) $rules['slug'] = ['required', 'min:3', 'alpha_dash', 'lowercase'];

        $validatedData = $request->validate($rules);

        $slug = (isset($validatedData['slug']) ? $validatedData['slug'] : SlugService::createSlug(Category::class, 'slug', $validatedData['name']));
        $validatedData['slug'] = $slug;

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}