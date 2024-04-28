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

	public function search(Request $request)
	{
		$movies = Movie::where('name', 'like', '%' . $request->input('search') . '%')->orWhere('description', 'like', '%' . $request->input('search') . '%')->paginate(15);

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
		$movies = $category->movies()->get();

		return response()->json($movies, 200);
	}

	public function linkToCategory(Movie $movie, Category $category)
	{
		if ($movie->categories()->where('categories.id', $category->id)->exists()) {
			return response()->json(['message' => 'Ce film est déjà relié à cette catégorie!'], 422);
		}

		$movie->categories()->attach($category);

		return response()->json(['message' => 'Le film a été relié à la catégorie avec succés!'], 200);
	}
}
