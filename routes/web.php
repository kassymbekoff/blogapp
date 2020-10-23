<?php

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/', \App\Http\Controllers\IndexController::class);
Route::get('/category/{slug}', \App\Http\Controllers\CategoryController::class);
Route::get('/tag/{slug}', \App\Http\Controllers\TagController::class);
Route::get('/post/{slug}', [\App\Http\Controllers\PostController::class, 'show']);

