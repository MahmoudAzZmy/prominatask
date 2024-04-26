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

Route::post('/albums/storeMedia', [App\Http\Controllers\AlbumController::class, 'storeMedia'])->name('albums.storeMedia');
Route::post('/albums/ckmedia', [App\Http\Controllers\AlbumController::class, 'storeCKEditorImages'])->name('storeCKEditorImages');
