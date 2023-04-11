<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str($this->title)->slug()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'slug' => 'unique:news,slug,'.$this->id,
            'content' => ['required'],
            'visible' => ['required'],
            'images.*' => ['nullable', 'mimes:jpeg,png,jpg,webp,JPEG,PNG,JPG,WEBP',]
        ];
    }

    public function messages() : array
    {
        return [
            'title.required' => 'El titulo de la noticia es requerido.',
            'title.min' => 'El titulo debe contener al menos 3 caracteres.',
            'title.max' => 'El titulo debe contener como máximo 255 caracteres.',
            'content.required' => 'El contenido de la noticia es requerido.',
            'slug.unique' => 'El slug de la noticia ya existe, elige otro titulo.',
            'visible.required' => 'La visibilidad de la noticia es requerida.',
            'images.*.mimes' => 'El archivo debe ser una imagen en formato JPEG, PNG, JPG, WEBP.',
        ];
    }
}
