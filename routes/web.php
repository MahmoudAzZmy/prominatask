<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/albums/index/{id?}', [App\Http\Controllers\AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('albums.create');
Route::post('/albums/store', [App\Http\Controllers\AlbumController::class, 'store'])->name('albums.store');
Route::get('/albums/show/{album}', [App\Http\Controllers\AlbumController::class, 'show'])->name('albums.show');
Route::get('/albums/edit/{album}', [App\Http\Controllers\AlbumController::class, 'edit'])->name('albums.edit');
Route::put('/albums/update/{album}', [App\Http\Controllers\AlbumController::class, 'update'])->name('albums.update');
Route::delete('/albums/destroy/{album}', [App\Http\Controllers\AlbumController::class, 'destroy'])->name('albums.destroy');

Route::get('/albums/transfer-pics-blade/{id}', [App\Http\Controllers\AlbumController::class, 'transferPicsBlade'])->name('albums.transfer-pics-blade');
Route::post('/albums/transfer-pics/{id}', [App\Http\Controllers\AlbumController::class, 'transferPic'])->name('albums.transfer-pics');







Route::get('/albums1/index', [App\Http\Controllers\AlbumsController2::class, 'index'])->name('albums1.index');
Route::get('/albums1/create', [App\Http\Controllers\AlbumsController2::class, 'create'])->name('albums1.create');
Route::post('/albums1/store', [App\Http\Controllers\AlbumsController2::class, 'store'])->name('albums1.store');
Route::get('/albums1/show/{album}', [App\Http\Controllers\AlbumsController2::class, 'show'])->name('albums1.show');
Route::get('/albums1/edit/{album}', [App\Http\Controllers\AlbumsController2::class, 'edit'])->name('albums1.edit');
Route::put('/albums1/update/{album}', [App\Http\Controllers\AlbumsController2::class, 'update'])->name('albums1.update');
Route::delete('/albums1/destroy/{album}', [App\Http\Controllers\AlbumsController2::class, 'destroy'])->name('albums1.destroy');
