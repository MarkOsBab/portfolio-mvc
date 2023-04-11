<?php

namespace App\Http\Requests\Project;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'string'],
            'description' => ['required', 'min:3'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'link' => ['nullable', 'url'],
            'images.*' => ['nullable', 'mimes:jpeg,png,jpg,webp,JPEG,PNG,JPG,WEBP',]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del proyecto es requerido',
            'name.min' => 'El nombre del proyecto debe contener como mínimo 3 caractes',
            'name.srting' => 'El formato del nombre del proyecto es incorrecto',
            'description.required' => 'La descripción del proyecto es requerida.',
            'description.min' => 'La descripción debe contener como mínimo 3 caracteres',
            'start_date.required' => 'La fecha de inicio es requerida.',
            'end_date.required' => 'La fecha de finalizado el proyecto es requerida.',
            'link.url' => 'El enlace del proyecto tiene un formato incorrecto.',
            'images.*.mimes' => 'El archivo debe ser una imagen en formato JPEG, PNG, JPG, WEBP.'
        ];
    }
}
