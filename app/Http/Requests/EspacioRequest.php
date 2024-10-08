<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspacioRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'rubro'=>'required',
            'ubicacion'=>'required',
            'cantidad'=>'required',
            'unidad_medida'=>'required',
            'precio_unitario'=>'required',
            'fecha_inicial'=>'required',
            'fecha_final'=>'required',
            'forma_pago'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'rubro.required' => 'El ingreso de rubro es obligatorio.',
            'ubicacion.required' => 'El ingreso de ubicacion es obligatorio.',
            'cantidad.required'   => 'El ingreso de cantidad es obligatorio.',
            'unidad_medida.required'   => 'El ingreso de unidad de medida es obligatorio.',
            'precio_unitario.required'   => 'El ingreso de precio unitario es obligatorio.',
            'fecha_inicial.required'   => 'El ingreso de fecha inicial es obligatorio.',
            'fecha_final.required'   => 'El ingreso de fecha final es obligatorio.',
            'forma_pago.required'   => 'El ingreso de forma pago es obligatorio.',
        ];
    }
}
