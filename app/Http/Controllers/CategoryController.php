<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$categories = Category::paginate(15);

		return response()->json($categories, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CategoryRequest $request)
	{
		$category = Category::create($request->validated());

		return response()->json($category, 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Category $category)
	{
		return response()->json($category, 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(CategoryRequest $request, Category $category)
	{
		$category->update($request->validated());
		$category->save();

		return response()->json($category, 200);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Category $category)
	{
		$category->delete();

		return response()->json(null, 204);
	}

	public function showByMovie(Movie $movie)
	{
		$categories = $movie->categories()->get();

		return response()->json($categories, 200);
	}

	public function linkToMovie(Category $category, Movie $movie)
	{
		if ($category->movies()->where('movies.id', $movie->id)->exists()) {
			return response()->json(['message' => 'Cette cagégorie est déjà reliée à ce film!'], 422);
		}

		$category->movies()->attach($movie);

		return response()->json(['message' => 'La catégorie a été reliée avec succés!'], 200);

	}
}
