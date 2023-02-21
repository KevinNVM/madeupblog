<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id', 'asc')->filter(request()->only(['search', 'category', 'author', 'hasLikes']))->paginate(10)->withQueryString();


        return Inertia::render('Posts/Index', [
            'posts' => fn () => $posts,
            'title' => 'All Posts'
        ]);
    }

    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post,
            'title' => $post->title
        ]);
    }
}
