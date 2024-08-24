<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:movies,title',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer|digits:4|min:1880|max:' . date('Y'),
            'description' => 'required|string|min:10|max:1000',
        ];
    }
}
