<?php

use App\Enums\Role\RoleEnum;
use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth.basic', 'role:' . RoleEnum::ADMIN])->prefix('blogs')->name('api.blogs.')->group(function() {
    Route::resource('', BlogController::class)->only(['store', 'index']);
    Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
    Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
});
