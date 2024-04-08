<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Front\PostController as FrontPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::name('front.')->group(function () {
    Route::prefix('posts')
        ->name('posts.')
        ->group(function () {
            Route::get('/{id}',
                [FrontPostController::class, 'show'])
            ->name('show');
        });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'is_admin'
])->prefix('admin')->name('admin.')
    ->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::resource('categories',
            CategoryController::class)
            ->except(['show'])
            ->parameters([
                'categories' => 'id'
            ]);
        Route::resource('posts',
            PostController::class)
            ->except(['show'])
            ->parameters([
                'posts' => 'id'
            ]);
});
