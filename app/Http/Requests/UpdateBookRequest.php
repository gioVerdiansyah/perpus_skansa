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
            'isbn' => ['required', 'max:19', Rule::unique('books', 'isbn')->ignore($this->book)],
            'title' => ['required', Rule::unique('books', 'title')->ignore($this->book)],
            'categories' => ['required', 'string', Rule::exists('categories', 'id')],
            'author' => ['required', 'string', Rule::exists('authors', 'id')],
            'publisher' => ['required', 'string', Rule::exists('publishers', 'id')],
            'description' => 'required|max:1000',
            'thumbnail' => 'file|image|max:10000'
        ];
    }
}