<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Post\Category;
use Inertia\Inertia;

class PostController extends Controller
{
    public function home()
    {
        return Inertia::render('Welcome', [
            'latest_articles' => Post::filter(request()->only(['search']))->latest()->limit(6)->get(),
            'popular_articles' => Post::orderBy('views', 'desc')->limit(6)->get(),
            'new_comers' => User::orderBy('created_at', 'asc')->limit(6)->get(),
            'title' => 'Home'
        ]);
    }

    public function index()
    {
        $posts = Post::latest('id', 'asc')->filter(request()->only(['search', 'category', 'author', 'hasLikes']))->paginate(10)->withQueryString();


        return Inertia::render('Posts/Index', [
            'posts' => fn () => $posts,
            'categories' => fn () => Category::all(),
            'title' => 'All Posts',
            'sq' => request()->search
        ]);
    }

    public function show(Post $post)
    {
        $post->increment('views');
        return Inertia::render('Posts/Show', [
            'post' => $post,
            'title' => $post->title
        ]);
    }
}
