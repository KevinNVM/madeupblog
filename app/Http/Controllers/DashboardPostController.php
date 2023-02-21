<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post\Category;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create new post';
        return Inertia::render('Posts/Create', ['title' => $title, 'categories' => Category::get(['id', 'name'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'body' => ['required', 'max:2000'],
            'category_id' => ['required']
        ];

        if ($request->slug) $rules['slug'] = ['min:5', 'alpha_dash', 'lowercase', 'unique:posts'];

        $validatedData = $request->validate($rules);

        $slug =
            time() . '-'
            . (isset($validatedData['slug']) ? $validatedData['slug'] : SlugService::createSlug(Post::class, 'slug', $validatedData['title']));

        $validatedData['user_id'] = Auth::user()->id;
        $validateddata['title'] = str($validatedData['title'])->title()->squish();
        $validatedData['slug'] = $slug;

        $newPost = new Post($validatedData);
        $newPost->save();
        return redirect()->route('posts.index')->with('message', 'Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!Auth::check() && Auth::user()->id !== $post->user_id) abort(404);
        return Inertia::render("Posts/Edit", [
            'post' => $post,
            'title' => "Edit $post->title",
            'categories' => Category::get(['id', 'name'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (!Auth::check() && Auth::user()->id !== $post->user_id) abort(404);
        $rules = [
            'title' => ['required', 'max:255'],
            'body' => ['required', 'max:2000']
        ];

        if ($request->slug && $request->slug !== $post->slug) $rules['slug'] = ['required', 'min:3', 'alpha_dash', 'lowercase', 'unique:posts'];
        elseif ($request->slug === $post->slug) $rules['slug'] = ['required', 'min:3', 'alpha_dash', 'lowercase'];

        $validatedData = $request->validate($rules);

        $slug =
            time() . '-'
            . (isset($validatedData['slug']) ? $validatedData['slug'] : SlugService::createSlug(Post::class, 'slug', $validatedData['title']));

        $validatedData['body'] = str_replace(['oembed', 'url', 'watch?v='], ['iframe', 'src', 'embed/'], $validatedData['body']);
        $validatedData['slug'] = $slug;

        $post->update($validatedData);
        return redirect()->route('posts.edit', $post->slug)->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!Auth::check() && Auth::user()->id !== $post->user_id) abort(404);
        $post->delete();
    }
}
