<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'control' => 'required|string|max:11',
            'nombre' => 'required|string|max:100',
            'password' => 'nullable|string|max:128',
            'email' => 'nullable|string|max:250',
            'esfuerzo_semanal' => 'required|integer|max:10',
            'apodo' => 'nullable|string|max:15',
            'estatus' => 'required|string',
            'remember_token' => 'required|string|max:100',
        ];
    }
    public static function getRules()
    {
        return (new static)->rules();
    }
}
