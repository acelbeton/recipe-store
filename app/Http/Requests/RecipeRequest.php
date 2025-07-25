<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'url' => 'nullable|url',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'image_url' => 'nullable|image|mimes:jpg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*' => 'string',
            'instructions' => 'nullable', // same thing maybe
            'servings' => 'nullable|integer|min:1',
            'created_by' => 'required|exists:users,id'
        ];
    }
}
