<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use Illuminate\Routing\RouteGroup;

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
    return view('welcome');
});


Auth::routes();

Route::group(['middleware'=>'auth'],function(){

  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::resource('/categories', CategoriesController::class);
  Route::resource('/tags', TagsController::class);
  Route::resource('/posts' ,PostsController::class);
  Route::get('/trashed-posts',[PostsController::class,'trashed'])->name('trashed.posts');
  Route::get('/trashed-restore/{id}',[PostsController::class,'restore'])->name('trashed.restore');
});

