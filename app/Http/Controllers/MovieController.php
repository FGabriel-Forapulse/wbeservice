<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$movies = Movie::paginate(15);

		return response()->json($movies, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(MovieRequest $request)
	{
		$movie = Movie::create($request->validated());

		return response()->json($movie, 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Movie $movie)
	{
		return response()->json($movie, 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(MovieRequest $request, Movie $movie)
	{
		$movie->update($request->validated());
		$movie->image = $request->image('image')->store('moviePosters');
		$movie->save();

		return response()->json($movie, 200);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Movie $movie)
	{
		$movie->delete();

		return response()->json(null, 204);
	}

	public function showByCategory(Category $category)
	{
		$movies = $category->movies();

		return response()->json($movies, 200);
	}
}
