<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\PreventBackHistory;


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

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');

//Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin']);
//Route::get('/admin', [AdminController::class, 'admin']);


Route::get('posts/search/', 'App\Http\Controllers\PostsController@search')->name('search');
//Route::get('/search/', [PostsController::class, 'search']);

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);

Route::get('/posts', [PostsController::class, 'index']);

Route::get('/project', [ProjectController::class, 'index']);

Route::resource('posts', 'App\Http\Controllers\PostsController');

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['/middleware' => 'prevent-back-history'],function(){
	Auth::routes();
	Route::get('/', [PagesController::class, 'index']);
});

