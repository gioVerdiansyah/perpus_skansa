<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'isbn' => 'required|max:19|unique:books,isbn',
            'title' => 'required|string|unique:books,title',
            'categories' => ['required', 'string', Rule::exists('categories', 'name')],
            'author' => ['required', 'string', Rule::exists('authors', 'name')],
            'publisher' => ['required', 'string', Rule::exists('publishers', 'name')],
            'description' => 'required',
            'thumbnail' => 'required|file|image|max:10000'
        ];
    }
}