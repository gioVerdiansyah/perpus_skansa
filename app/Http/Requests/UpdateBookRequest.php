<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
            'isbn' => ['required', 'max:19', Rule::exists('books', 'isbn')],
            'title' => ['required', 'string', Rule::exists('books', 'title')],
            'categories' => ['required', 'string', Rule::exists('categories', 'name')],
            'author' => ['required', 'string', Rule::exists('authors', 'name')],
            'publisher' => ['required', 'string', Rule::exists('publishers', 'name')],
            'description' => 'required',
            'thumbnail' => 'file|image|max:10000'
        ];
    }
}