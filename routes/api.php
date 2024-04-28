<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::resource('movies', MovieController::class);

Route::get('movies/category/{category}', [MovieController::class, 'showByCategory']);
Route::get('/search/movies', [MovieController::class, 'search']);