<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StoryController;


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

// Auth::routes();

// // Comment Router
// // Route::resource('comments', CommentController::class);
// Route::resource('comments', 'CommentController');


//Post Router
// Route::get('/',[PostsController::class, 'index'])->name('post.index');
// Route::get('/p/create',[PostsController::class, 'create'])->name('post.create');
// Route::post('/p',[PostsController::class, 'store'])->name('post.store');
// Route::get('/p/{post}',[PostsController::class, 'show'])->name('post.show');
// Route::delete('/p/{post}',[PostsController::class, 'destroy'])->name('post.destroy');
// Route::post('/p/{post}',[PostsController::class, 'updatelikes'])->name('post.update');
// Route::get('/explore',[PostsController::class, 'explore'])->name('post.explore');
// Route::get('posts',[PostsController::class, 'vue_index']);
// Route::get('/profile/{user}',[ProfilesController::class, 'index'])->name('profile.index');
// Route::get('/profile/{user}/edit',[ProfilesController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile/{user}',[ProfilesController::class, 'update'])->name('profile.update');
// Route::any('/search',[ProfilesController::class, 'search'])->name('profile.search');
// Route::post('/follow/{user}',[FollowsController::class, 'store']);
// Route::get('/stories/create',[StoryController::class, 'create'])->name('stories.create');
// Route::post('/stories',[StoryController::class, 'store'])->name('stories.store');
// Route::get('/stories/{story}',[StoryController::class, 'show'])->name('stories.show');
// Route::post('like/{like}',[LikeController::class, 'update2'])->name('like.create');
// Route::post('like/{like}', 'LikeController@update2')->name('like.create');

// Email Verification Controller
Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class, 'verifyUser'])->name('verify.user');




Auth::routes();


// Comment Route
Route::resource('comments', 'App\Http\Controllers\CommentController');

// Post Route
Route::get('/', 'App\Http\Controllers\PostsController@index')->name('post.index');
Route::get('/p/create', 'App\Http\Controllers\PostsController@create')->name('post.create');
Route::post('/p', 'App\Http\Controllers\PostsController@store')->name('post.store');
Route::delete('/p/{post}', 'App\Http\Controllers\PostsController@destroy')->name('post.destroy');
Route::get('/p/{post}', 'App\Http\Controllers\PostsController@show')->name('post.show');
Route::post('/p/{post}', 'App\Http\Controllers\PostsController@updatelikes')->name('post.update'); //  This need more time
Route::get('/explore', 'App\Http\Controllers\PostsController@explore')->name('post.explore'); // Explore Page
Route::get('/posts', 'App\Http\Controllers\PostsController@vue_index'); // Infinite scrolling
Route::get('/profile/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.index');
Route::get('/profile/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');
Route::post('/search', 'App\Http\Controllers\ProfilesController@search')->name('profile.search'); // Search Page
Route::post('/follow/{user}', 'App\Http\Controllers\FollowsController@store');

Route::post('/stories', 'App\Http\Controllers\StoryController@store')->name('stories.store');
Route::get('/stories/create', 'App\Http\Controllers\StoryController@create')->name('stories.create');
Route::get('/stories/{user}', 'App\Http\Controllers\StoryController@show')->name('stories.show');


Route::post('like/{like}', 'App\Http\Controllers\LikeController@update2')->name('like.create');



