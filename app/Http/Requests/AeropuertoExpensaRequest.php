<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AeropuertoExpensaRequest extends FormRequest
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
            'aeropuerto'=>'required',
            'factor'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'aeropuerto.required' => 'El ingreso de aeropuerto es obligatorio.',
            'factor.required'   => 'El ingreso de factor es obligatorio.',
        ];
    }
    
}
