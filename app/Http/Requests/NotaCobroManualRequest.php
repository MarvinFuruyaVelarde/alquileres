<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaCobroManualRequest extends FormRequest
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
            'aeropuerto'=>'required',
            'cliente'=>'required',
            'codigo'=>'required',
            'periodo_facturacion'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'aeropuerto.required' => 'El ingreso de aeropuerto es obligatorio.',
            'cliente.required' => 'El ingreso de cliente es obligatorio.',
            'codigo.required' => 'El ingreso de código de contrato es obligatorio.',
            'periodo_facturacion.required'   => 'El ingreso de periodo de facturación es obligatorio.',
        ];
    }
}
