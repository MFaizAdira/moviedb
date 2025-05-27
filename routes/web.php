<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/',[MovieController::class, 'homePage']);

Route::get('movie/{id}/{slug}',[MovieController::class, 'detail']);

Route::get('create_movie', [MovieController::class, 'create'])->name('createMovie');

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

