<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'ap_paterno'=>'required',
            'ap_materno'=>'required',
            'nombres'=>'required',
            'fecha_nacimiento'=>'required',
            'sexo'=>'required',
            'estado_civil'=>'required',
            'ciudad_id'=>'required',
            'ci'=>[
                'required',
                'numeric',
                Rule::unique('empleados')->ignore( $this->route('empleado') )
            ],
            'domicilio'=>'required',
            'email' => [
                'required',
                'email',
                Rule::unique('empleados')->ignore( $this->route('empleado') )
            ],
            'nro_celular'=>'required|numeric',
            'contacto_nombre'=>'required',
            'contacto_telefono'=>'required|numeric',
            'contacto_parentesco'=>'required',
            'formacion_id'=>'required',
            'institucion_formacion_id'=>'required',
            'ultimo_empleo'=>'required',
            'fecha_ingreso'=>'required',
            'cargo_id'=>'required',
            'nro_cuenta'=>'required',
            'banco_id'=>'required',
            'afp_id'=>'required',
            'seguro_salud_id'=>'required',
            'fecha_registro'=>'required',
            'foto' => 'nullable|image|max:2048'
        ];
    }
}
