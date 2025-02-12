<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetallePagoFacturaRequest extends FormRequest
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
        if ($this->_method === 'PUT') {
            $rules =[
                'pagar' => 'required',
                'cuenta_destino' => 'required',
                'fecha_actual' => 'required',
                'registro_deposito' => 'required',
                'fecha_deposito'=>Rule::requiredIf($request->input('cuenta_destino')==7 || $request->input('cuenta_destino')==8 )
            ];
            return $rules;
        } else{
            return [
                'pagar' => 'required',
                'cuenta_destino' => 'required',
                'fecha_actual' => 'required',
                'registro_deposito' => 'required',
                'fecha_deposito'=>Rule::requiredIf($request->input('cuenta_destino')==7 || $request->input('cuenta_destino')==8 )
            ];
        }
    }

    public function messages()
    {
        return [
            'fecha_actual.required' => 'El campo fecha de pago es obligatorio.',
        ];
    }
}
