<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CancelarContratoRequest extends FormRequest
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
        $codigoContrato = $this->route('cancelarcontratos'); // Obtiene el ID del cliente desde la ruta, si existe

        return [
            'codigo' => [
                'required',
                'string',
                Rule::unique('contrato')->ignore($codigoContrato)
            ],

            'motivo'=>'required',
            'documento_respaldo'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'motivo.required' => 'El ingreso de motivo es obligatorio.',
            'documento_respaldo.required' => 'El documento de respaldo es obligatorio.',

        ];
    }
}
