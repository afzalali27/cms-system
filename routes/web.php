<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');



// this is auth middleware any function inside this require to pass
// middle ware otherwise redirect to login page or whatever page mentionedby 
// middleware
Route::middleware('auth')->group(function(){

    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
    // post
    Route::get('/admin/posts/create',[App\Http\Controllers\PostController::class,'create'])->name('posts.create');
    Route::post('/admin/posts',[App\Http\Controllers\PostController::class,'store'])->name('posts.store');
    Route::get('/admin/posts',[App\Http\Controllers\PostController::class,'index'])->name('posts.index');

});