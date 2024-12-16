<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RubroRequest extends FormRequest
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
        $rubroId = $this->route('rubro'); // Obtiene el ID del cliente desde la ruta, si existe

        return [
            'codigo' => [
                'required',
                'integer',
                Rule::unique('rubro', 'codigo')->ignore($rubroId)
            ],

            'descripcion'=>'required',
            'estado'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'codigo.required' => 'El código es obligatorio.',
            'codigo.integer' => 'El código debe ser un número entero.',
            'codigo.unique' => 'El código ya se encuentra registrado, ingrese uno nuevo.',
            'descripcion.required' => 'El ingreso de descripción es obligatorio.',
            'estado.required'   => 'El ingreso de estado es obligatorio.',
        ];
    }
}
