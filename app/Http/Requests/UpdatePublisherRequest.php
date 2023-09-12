<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePublisherRequest extends FormRequest
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
        $publisherId = $this->route('publisher');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('publishers', 'name')->ignore($publisherId),
            ],
            'address' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('publishers', 'email')->ignore($publisherId),
            ],
            'phone' => [
                'required',
                'numeric',
                'gt:0',
                Rule::unique('publishers', 'phone')->ignore($publisherId),
            ],
            'website' => 'required|url',
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:10000',
            'since' => 'required|numeric|min:1900|max:' . date('Y'),
            'description' => 'required|string|max:1000',
        ];
    }

}