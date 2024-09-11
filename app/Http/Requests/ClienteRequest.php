<?php

namespace App\Http\Requests;

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
        return [
            'razon_social' => 'required',
            'tipo_identificacion' => 'required',
            'numero_identificacion' => 'required',
            'tipo_solicitante' => 'required',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'razon_social.required' => 'El ingreso de razón social es obligatorio.',
            'tipo_identificacion.required' => 'El ingreso de tipo de identificación es obligatorio.',
            'numero_identificacion.required' => 'El ingreso de número de identificación es obligatorio.',
            'tipo_solicitante.required' => 'El ingreso de tipo de solicitante es obligatorio.',
            'estado.required' => 'El ingreso de estado es obligatorio.',
        ];
    }
}
