<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'username' => 'required|alpha_dash|exists:users,username',
            'password' => 'required',
        ];
    }


    public function messages()
    {
        return [
          'username.required' => 'Номи корбариро нависед',
          'username.exists' => 'Номи корбари ёфта нашуд!',
          'password.required' => 'Рамзро нависед'
        ];
    }
}
