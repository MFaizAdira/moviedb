<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;

// Halaman utama
Route::get('/', [MovieController::class, 'homePage']);

// Detail film
Route::get('movie/{id}/{slug}', [MovieController::class, 'detail']);

// List semua movie (opsional, untuk datatable)
Route::get('/movie', [MovieController::class, 'index'])->name('movies.index');

// Tambah film (hanya untuk user yang login)
Route::get('create_movie', [MovieController::class, 'create'])->name('create_movie')->middleware('auth');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');

// CRUD Movie
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit')->middleware('auth');
Route::put('/movie/{id}', [MovieController::class, 'update'])->name('movies.update')->middleware('auth');
Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('movies.destroy')->middleware('auth');

// Login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');

// Data Movie Table
Route::get('/datamovie', [MovieController::class, 'datamovie'])->name('layouts.datamovie');

// Search Movie
Route::get('/search', [MovieController::class, 'search'])->name('searchMovie');
