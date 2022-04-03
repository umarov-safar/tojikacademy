<?php

namespace App\Http\Requests;

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
        return auth()->check();
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
            'last_name' => 'nullable|string|min:3',
            'email' => 'nullable|unique:users,email,' . $this->id,
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
//            'avatar' => 'nullable|mimes:jpg,png,jpeg,webp|max:5048'
        ];
    }


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
            'avatar.mimes' => 'Лутфан акс интихоб кунед'
        ];
    }
}
