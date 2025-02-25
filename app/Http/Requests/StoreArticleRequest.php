<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
    public function rules()
{
    return [
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'image'       => 'nullable|image',
        'theme_id'    => 'required|exists:themes,id',
        'date'        => 'required|date',
    ];
}
}
