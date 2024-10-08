<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GarantiaRequest extends FormRequest
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
        $rules = [
            'a_pagar' => 'required',
            'cuenta_destino' => 'required',
        ];
    
        // Condicionalmente agregar la regla para fecha_deposito
        if ($request->input('cuenta_destino')==8) { // Cambia 'some_condition' por la condición que determines
            $rules['fecha_deposito'] = 'required';
        }
    
        return $rules;
    }
    public function messages()
    {
        return [
            'a_pagar.required' => 'El ingreso del importe a pagar es obligatorio.',
            'cuenta_destino.required' => 'El ingreso de la cuenta destino es obligatorio.',
            //'fecha_deposito.required' => 'El ingreso de la fecha de deposito es obligatorio.',
        ];
    }
}
