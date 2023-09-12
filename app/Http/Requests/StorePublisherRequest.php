<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublisherRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:publishers,name',
            'address' => 'required|string',
            'email' => 'required|email|unique:publishers,email',
            'phone' => 'required|numeric|gt:0|unique:publishers,phone',
            'website' => 'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'since' => 'required|numeric|min:1900|max:' . date('Y'),
            'description' => 'required|string|max:1000',
        ];
    }

}