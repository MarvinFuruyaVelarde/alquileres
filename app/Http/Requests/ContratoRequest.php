<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContratoRequest extends FormRequest
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
            'codigo'=>'required',
            'aeropuerto'=>'required',
            'tipo_solicitante'=>'required',
            'cliente'=>'required',
            'domicilio_legal'=>'required',
            'telefono_celular'=>'required',
            'correo'=>'required',
            'actividad_principal'=>'required',
            'representante1'=>'required',
            'numero_documento1'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El ingreso de código es obligatorio.',
            'aeropuerto.required' => 'El ingreso de aeropuerto es obligatorio.',            
            'tipo_solicitante.required'   => 'El ingreso de tipo de solicitante es obligatorio.',
            'cliente.required'   => 'El ingreso de cliente es obligatorio.',
            'domicilio_legal.required'   => 'El ingreso de domicilio legal es obligatorio.',
            'telefono_celular.required'   => 'El ingreso de telefono/celular es obligatorio.',
            'correo.required'   => 'El ingreso de correo es obligatorio.',
            'actividad_principal.required'   => 'El ingreso de actividad principal es obligatorio.',
            'representante1.required'   => 'El ingreso de representante es obligatorio.',
            'numero_documento1.required'   => 'El ingreso de numero documento es obligatorio.',
        ];
    }
}
