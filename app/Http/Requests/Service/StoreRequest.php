<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['required'],
            'visible' => ['required'],
            'cost_range' => ['required', 'numeric'],
            'thumbnail' => ['required', 'mimes:svg,png,webp,SVG,PNG,WEBP'],
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'El nombre del servicio es requerido.',
            'description.required' => 'La descripción del servicio es requerida.',
            'visible.required' => 'La visibilidad del servicio es requerida.',
            'thumbnail.required' => 'La miniatura del servicio es requerida.',
            'thumbnail.mimes' => 'El formato de la miniatura debe ser SVG, PNG, WEBP',
        ];
    }
}
