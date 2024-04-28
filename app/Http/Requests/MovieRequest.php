<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => ['required', 'max:128'],
			'description' => ['required', 'max:2048'],
			'release_date' => ['required', 'date'],
			'rating' => ['nullable', 'integer', 'min:0', 'max:5'],
			'image' => 'nullable|file',
		];
	}
}
