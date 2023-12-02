<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => 'string|email|required|unique:users',
            'name' => 'string|required',
            'lastname' => 'string|required',
            'password' => 'string|required',
            'image' => 'string',
            'phone' => 'string|required',
            'status' => 'boolean'
        ];
    }

    function messages(): array {
        return [

            // Email
            'email.email' => 'El email tiene que ser un string',
            'email.email' => 'El email no tiene el formato correcto',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',

            // Name
            'name.string' => 'El nombre tiene que ser un string',
            'name.required' => 'El nombre es requerido',

            // Name
            'lastname.string' => 'El apellido tiene que ser un string',
            'lastname.required' => 'El apellido es requerido',

            // Password
            'password.string' => 'La contraseña tiene que ser un string',
            'password.required' => 'La contraseña es requerida',

            // Phone
            'phone.string' => 'El telefono tiene que ser un string',
            'phone.required' => 'El telefono es requerido',

            // Status
            'status.boolean' => 'El status tiene que ser un booleano'

            //'image' => 'string',
        ];
    }
}
