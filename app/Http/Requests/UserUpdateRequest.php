<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia esto si quieres manejar permisos
    }

    public function rules()
    {
        $userId = $this->route('user')->id ?? null; // obtiene el id del usuario que viene en la ruta

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId), // evita conflicto con su propio correo
            ],
            'rfc' => ['nullable', 'string', 'max:13'],
            'role' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            // si quieres agregar reglas personalizadas:
            // 'name' => ['required', 'string', 'max:255', new NotProfane()],
        ];
    }

    // Opcional: personalizar mensajes de error
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ser un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'rfc.max' => 'El RFC no puede superar los 13 caracteres.',
            'address.max' => 'La dirección no puede superar los 255 caracteres.',
            'phone.max' => 'El teléfono no puede superar los 20 caracteres.',
        ];
    }
}
