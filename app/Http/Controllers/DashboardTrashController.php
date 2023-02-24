<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class DashboardTrashController extends Controller
{
    // Post Trash Index
    public function index(): Response
    {
        return Inertia::render("Trash/Index", [
            'posts' => Post::where('user_id', Auth::user()->id)->onlyTrashed()->latest()->paginate(20),
        ]);
    }

    // Restore Item
    public function update($slug): RedirectResponse
    {
        dd($slug);
        $post = Post::withTrashed()->where('slug', $slug)->firstOrFail();
        $post->restore();
        return redirect()->route('trashed.index');
    }

    // Force Delete Item
    public function destroy(Post $post): RedirectResponse
    {
        $post->forceDelete();
        return redirect()->route('trashed.index');
    }
}
