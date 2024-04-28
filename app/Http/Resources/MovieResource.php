<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'name' => $this->name,
			'description' => $this->description,
			'release_date' => $this->release_date,
			'rating' => $this->rating,
			'image' => $this->image,			
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
