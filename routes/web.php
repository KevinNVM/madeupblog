<?php

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Post\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HelpersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardPostCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::resource('posts/categories', CategoryController::class)->only(['index', 'show']);
Route::resource('posts', PostController::class)->only(['index', 'show']);
Route::resource('dashboard/posts/categories', DashboardPostCategoryController::class)->except(['index', 'show']);
Route::resource('dashboard/posts', DashboardPostController::class)->except(['index', 'show']);

Route::get('/about', fn () => Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
]));

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->where('alias', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// Helpers
Route::prefix('/session-helpers')->group(function () {
    Route::post('/posts/actions/like', [HelpersController::class, 'postsActionsLike'])->name('posts.actions.like');
});
Route::prefix('/helpers')->group(function () {
    Route::get('/posts/get-post-categories', [HelpersController::class, 'getPostCategories'])->name('posts.actions.getCategories');
});
