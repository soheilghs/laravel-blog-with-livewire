<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'is_admin'
])->prefix('admin')->name('admin.')
    ->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('categories')
        ->name('category.')
        ->group(function () {
            Route::get('/',
                [CategoryController::class, 'index'])
                ->name('all');
            Route::get('/create',
                [CategoryController::class, 'create'])
                ->name('create');
            Route::post('/',
                [CategoryController::class, 'store'])
                ->name('store');
            Route::get('/{id}',
                [CategoryController::class, 'edit'])
                ->name('edit');
        });
});
