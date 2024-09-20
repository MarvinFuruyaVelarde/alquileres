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
          
            'name'=>'required',
            'ci'=>'required',
            'expedido'=>'required',
            'estado'=>'required',
            'role_id'=>'required',
        ];

    }
    
}
