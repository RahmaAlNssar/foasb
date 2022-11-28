<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

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




Route::middleware(['auth:admin','ckeck_status'])->as('admin.')->group(function () {

    Route::resource('admins','App\Http\Controllers\Backend\AdminController');
    Route::post('admins/status/{id}/column/{column}',[App\Http\Controllers\Backend\AdminController::class,'updateStatus'])->name('admins.status');
    Route::delete('admins/delete/delete_all',[App\Http\Controllers\Backend\AdminController::class,'MultiDelete'])->name('admins.delete_all');

    Route::resource('categories','App\Http\Controllers\Backend\CategoryController');
    Route::post('categories/status/{id}/column/{column}',[App\Http\Controllers\Backend\CategoryController::class,'updateStatus'])->name('categories.status');
    Route::delete('categories/delete/delete_all',[App\Http\Controllers\Backend\CategoryController::class,'MultiDelete'])->name('categories.delete_all');

    Route::resource('subcats','App\Http\Controllers\Backend\SubcatController');
    Route::post('subcats/status/{id}/column/{column}',[App\Http\Controllers\Backend\SubcatController::class,'updateStatus'])->name('subcats.status');
    Route::delete('subcats/delete/delete_all',[App\Http\Controllers\Backend\SubcatController::class,'MultiDelete'])->name('subcats.delete_all');

    Route::resource('posts','App\Http\Controllers\Backend\PostController');
    Route::post('posts/status/{id}/column/{column}',[App\Http\Controllers\Backend\PostController::class,'updateStatus'])->name('posts.status');
    Route::delete('posts/delete/delete_all',[App\Http\Controllers\Backend\PostController::class,'MultiDelete'])->name('posts.delete_all');
    Route::get('posts/gallery/{id}',[App\Http\Controllers\Backend\PostController::class,'Gallery'])->name('posts.gallery');

    Route::get('orders',[App\Http\Controllers\Backend\OrderController::class,'index'])->name('orders.index');
    Route::get('messages',[App\Http\Controllers\Backend\MessageController::class,'index'])->name('messages.index');
});


