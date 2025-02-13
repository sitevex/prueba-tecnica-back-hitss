<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CargoListRequest extends FormRequest
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
            'search' => 'nullable|string|max:100',
            'status' => 'nullable|in:all,active,inactive',
            'paginate' => 'nullable|string|in:true,false',
            'perPage' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
            'sortBy' => 'nullable|string|in:id,nombre,created_at', // Campos permitidos para ordenar
            'sortDirection' => 'nullable|string|in:asc,desc',
        ];
    }

    /**
     * Mensajes personalizados para las reglas de validación.
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'search.max' => 'La búsqueda no puede tener más de 100 caracteres.',
            'status.in' => 'El estado debe ser "active" o "inactive".',
            'paginate.in' => 'El campo de paginación debe ser "true" o "false".',
            'perPage.integer' => 'El código de la paginación debe ser un número entero.',
            'perPage.min' => 'El número mínimo de elementos por página es 1.',
            'perPage.max' => 'El número máximo de elementos por página es 100.',
            'sortBy.in' => 'El campo para ordenar debe ser uno de los siguientes: id, nombre, created_at.',
            'sortDirection.in' => 'La dirección de orden debe ser "asc" o "desc".',
        ];
    }

    /**
     * Sobrescribir failedValidation para retornar JSON
     * 
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Invalid query paramenters',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
