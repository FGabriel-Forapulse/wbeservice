<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::resource('movies', MovieController::class);
Route::get('movies/categories/{category}', [MovieController::class, 'showByCategory']);
Route::get('/search/movies', [MovieController::class, 'search']);
Route::post('movies/{movie}/categories/{category}/link', [MovieController::class, 'linkToCategory']);

Route::resource('categories', CategoryController::class);
Route::get('categories/movies/{movie}', [CategoryController::class, 'showByMovie']);
Route::post('categories/{category}/movies/{movie}/link', [CategoryController::class, 'linkToMovie']);