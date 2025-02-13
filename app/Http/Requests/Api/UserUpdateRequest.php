<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
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
            'idUser' => ['required', 'integer', 'exists:users,id'],
            'usuario' => ['required', 'string', 'max:50', 'unique:users,usuario,' . $this->idUser],
            'primerNombre' => ['required', 'string', 'max:50'],
            'segundoNombre' => ['nullable', 'string', 'max:50'],
            'primerApellido' => ['required', 'string', 'max:50'],
            'segundoApellido' => ['nullable', 'string', 'max:50'],
            'idDepartamento' => ['required', 'integer', 'exists:departamentos,id'],
            'idCargo' => ['required', 'integer', 'exists:cargos,id'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,' . $this->idUser],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'idUser.required' => 'El ID del usuario es obligatorio.',
            'idUser.integer' => 'El ID del usuario debe ser un número.',
            'idUser.exists' => 'El usuario seleccionado no existe.',

            'usuario.required' => 'El campo usuario es obligatorio.',
            'usuario.string' => 'El usuario debe ser una cadena de texto.',
            'usuario.max' => 'El usuario no puede exceder los 50 caracteres.',
            'usuario.unique' => 'Este nombre de usuario ya está en uso.',

            'primerNombre.required' => 'El primer nombre es obligatorio.',
            'primerNombre.string' => 'El primer nombre debe ser una cadena de texto.',
            'primerNombre.max' => 'El primer nombre no puede exceder los 50 caracteres.',

            'segundoNombre.string' => 'El segundo nombre debe ser una cadena de texto.',
            'segundoNombre.max' => 'El segundo nombre no puede exceder los 50 caracteres.',

            'primerApellido.required' => 'El primer apellido es obligatorio.',
            'primerApellido.string' => 'El primer apellido debe ser una cadena de texto.',
            'primerApellido.max' => 'El primer apellido no puede exceder los 50 caracteres.',

            'segundoApellido.string' => 'El segundo apellido debe ser una cadena de texto.',
            'segundoApellido.max' => 'El segundo apellido no puede exceder los 50 caracteres.',

            'idDepartamento.required' => 'El departamento es obligatorio.',
            'idDepartamento.integer' => 'El departamento debe ser un número.',
            'idDepartamento.exists' => 'El departamento seleccionado no existe.',

            'idCargo.required' => 'El cargo es obligatorio.',
            'idCargo.integer' => 'El cargo debe ser un número.',
            'idCargo.exists' => 'El cargo seleccionado no existe.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede exceder los 100 caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
        ];
    }

    
    /**
     * Manejo de validación fallida.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => 'Invalid input.',
            'errors' => $validator->errors(),
        ], 422));

    }

}
