<?php

namespace App\Http\Requests\Tag;

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
            'name' => ['required', 'min:3', 'regex:/^\S*$/', 'unique:tags,name,'.$this->id]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tag es requerido.',
            'name.min' => 'El tag debe contener como minimo 3 caracteres.',
            'name.regex' => 'El campo debe contener solo una palabra.' ,
            'name.unique' => 'El tag ya existe.',
        ];
    }
}
