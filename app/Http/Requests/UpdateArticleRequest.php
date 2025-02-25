<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image'       => 'nullable|image',
            'theme_id'    => 'sometimes|required|exists:themes,id',
            'date'        => 'sometimes|required|date',
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'title.required'       => "Le titre de l'article est obligatoire lorsqu'il est fourni.",
            'title.string'         => "Le titre doit être une chaîne de caractères.",
            'title.max'            => "Le titre ne doit pas dépasser 255 caractères.",
            'description.required' => "La description est obligatoire lorsqu'elle est fournie.",
            'description.string'   => "La description doit être une chaîne de caractères.",
            'image.image'          => "Le fichier sélectionné doit être une image.",
            'theme_id.required'    => "Le thème est obligatoire lorsqu'il est fourni.",
            'theme_id.exists'      => "Le thème sélectionné est invalide.",
            'date.required'        => "La date de publication est obligatoire lorsqu'elle est fournie.",
            'date.date'            => "La date de publication doit être une date valide.",
        ];
    }
}
