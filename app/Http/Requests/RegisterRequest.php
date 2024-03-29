<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'username' => 'required|alpha_dash|min:4|unique:users,username,'.$this->id,
            'email' => 'nullable|unique:users,email,' . $this->id,
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * @return array|void
     */
    public function messages()
    {
        return [
            'name.required' => 'Лутфан номро пур кунед!',
            'username.unique' => 'Алакай инхел ном гирифта шудааст!',
            'username.required' => 'Лутфан номи барои воридшавиро нависед!',
            'username.alpha_dash' => 'Номи корбари бояд танҳо ҳарф ва рақам дошта бошад!',
            'username.min' => 'Лутфан аз чор ҳарф зиёд нависед!',
            'name.min' => 'Ном бояд аз 3 ҳарф зиёд бошад!',
            'email.unique' => 'Email алкай гирифта шуда аст!',
            'password.required' => 'Рамзро пур кунед!',
            'password.confirmed' => 'Рамзҳо як хела нестанд!',
            'password_confirmation.required' => 'Рамзи такрориро пур кунед!',
        ];
    }
}
