<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use MongoDB\Client;

Route::get('/', [PostController::class,'index'])
    ->middleware('auth')    
    ->name('home');

Route::get('/ping', function () {
    try {
        $client = new Client(env('DB_HOST'));
        $client->listDatabases(); // Forces a connection
        return response()->json(['msg' => 'MongoDB is accessible!']);
    } catch (\Exception $e) {
        return response()->json(['msg' => 'Could not connect to MongoDB: ' . $e->getMessage()]);
    }
});

Auth::routes();

Route::controller(PostController::class)
    ->prefix('posts')
    ->name('posts.')
    ->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/{post}/show','show')->name('show');
        Route::get('/{post}/edit','edit')->name('edit');
        Route::patch('/{post}/update','update')->name('update');
        Route::delete('/{post}/destroy','destroy')->name('destroy');
    });

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
