<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['auth','admin'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/users',[UsersController::class,'index'])->name('users.index');
  Route::post('/users/{user}/make-admin',[UsersController::class,'makeAdmin'])->name('users.make-admin');
  Route::post('/users/{user}/make-user',[UsersController::class,'makeUser'])->name('users.make-user');
});

Route::middleware(['auth'])->group(function () {

  Route::get('/users/{user}/profile',[UsersController::class,'edit'])->name('users.edit');
  Route::post('/users/{user}/profile',[UsersController::class,'update'])->name('users.update');
});