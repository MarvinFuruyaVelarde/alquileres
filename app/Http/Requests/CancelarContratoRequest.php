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
        $codigoContrato = $this->route('cancelarcontratos'); // ID del contrato de la ruta
        $objetivo = $this->input('objetivo');

        if ($objetivo === 'M' || $objetivo === 'A') {
            $rules['motivo'] = 'required';
            $rules['documento_respaldo'] = ['required', 'file', 'mimes:pdf', 'max:5120'];
        }

        if ($objetivo === 'M') {
            $rules['codigo'] = [
                'required',
                'string',
                Rule::unique('contrato', 'codigo')->ignore($codigoContrato),
            ];
        }

        if ($objetivo === 'C') {
            $rules['correo'] = [
                'required',
                'email', // puedes ajustar la validación si el correo no debe ser formato email
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'motivo.required' => 'El ingreso de motivo es obligatorio.',
            'documento_respaldo.required_if' => 'El documento de respaldo es obligatorio.',
            'codigo.required' => 'Debe ingresar el nuevo código.',
            'codigo.unique' => 'Ya existe un contrato con ese código.',
            'correo.required' => 'Debe ingresar el correo.',
            'correo.email' => 'Debe ingresar un correo válido.',
        ];
    }
}
