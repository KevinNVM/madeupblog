<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HelpersController extends Controller
{
    public function postsActionsLike(Request $request)
    {
        // enum [0, 1, 2] = ['invalid param', 'success', 'already liked']

        if ($request->session()->exists('posts_actions_like_from') && $request->session()->get('posts_actions_like_from') === $request->from) return 2;

        $post = Post::where('slug', $request->from)->first();
        $post->likes++;
        $post->save();

        $request->session()->put('posts_actions_like_from', $request->from);
        return 1;
    }

    public function getPostCategories()
    {
        $categories = Category::get()->map(function ($category) {
            return ['label' => $category->name, 'value' => $category->slug];
        });
        return response()->json($categories, 200);
    }
}