<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
	//use HasFactory;

	protected $fillable = [
		'name',
		'description',
		'release_date',
		'rating',
		'image',
	];

	public function category(): BelongsToMany
	{
		return $this->belongsToMany(Category::class, 'category_user');
	}
}
