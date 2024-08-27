<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore( $this->route('user') )
            ],
            'password' => ['required',Rule::unique('users')->ignore( $this->route('user') )],
            'name'=>'required',
            'role_id'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'El campo es de ingreso obligatorio.',
            'email.required' => 'El campo es de ingreso obligatorio.',
            'email.unique'   => 'El correo ingresado ya fue utilizado.',
            'password.required' => 'Debe ingresar una contraseña.',
            'role_id.required' => 'Debe asignar un rol al usuario.',
        ];
    }
}
