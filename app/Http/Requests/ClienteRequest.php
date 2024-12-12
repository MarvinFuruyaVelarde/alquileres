<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request)
    {
        $clienteId = $this->route('cliente'); // Obtiene el ID del cliente desde la ruta, si existe

        return [
            'razon_social' => [
                'required',
                'string',
                Rule::unique('cliente')->ignore($clienteId)
            ],

            'tipo_identificacion' => 'required',
            'numero_identificacion' => 'required',
            'tipo_solicitante' => 'required',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'tipo_identificacion.required' => 'El ingreso de tipo de identificación es obligatorio.',
            'numero_identificacion.required' => 'El ingreso de número de identificación es obligatorio.',
            'tipo_solicitante.required' => 'El ingreso de tipo de solicitante es obligatorio.',
            'estado.required' => 'El ingreso de estado es obligatorio.',
        ];
    }
}
