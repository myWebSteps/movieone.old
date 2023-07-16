<?php

namespace App\Http\Requests\API\Admin\Movies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'kinopoisk_id'=>'required|string',
            'nameRu'=>'required|string',
            'nameOriginal'=>'required|string',
            'countries' => 'required',
            'category_id'=>'required|string',
            'subcategories'=>'required|string',
            'year'=>'required|string',
            'duration'=>'required|string',
            'rate'=>'required|string',
            'slogan'=>'required|string',
            'description'=>'required|string',
            'files' => 'nullable',
            'type'=>'required|string',
        ];
    }
}
