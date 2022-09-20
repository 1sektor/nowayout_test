<?php

use App\Enums\Role\RoleEnum;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\Admin\BlogController as AdminBlogController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth', 'role:' . RoleEnum::MEMBER])->group(function() {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
});

Route::middleware(['auth', 'role:' . RoleEnum::ADMIN])->prefix('admin')->group(function() {
    Route::prefix('blogs')->group(function() {
        Route::get('/store', [AdminBlogController::class, 'store'])->name('blogs.store');
        Route::get('/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
