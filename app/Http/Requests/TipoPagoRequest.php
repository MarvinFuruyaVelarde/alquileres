<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPagoRequest extends FormRequest
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
    public function rules()
    {
        return [
            'descripcion'=>'required',
            'numero_cuenta'=>'required',
            'moneda'=>'required',
            'estado'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'descripcion.required' => 'El ingreso de descripción es obligatorio.',
            'numero_cuenta.required' => 'El ingreso de número de cuenta es obligatorio.',
            'moneda.required' => 'El ingreso de moneda es obligatorio.',
            'estado.required'   => 'El ingreso de estado es obligatorio.',
        ];
    }
}
