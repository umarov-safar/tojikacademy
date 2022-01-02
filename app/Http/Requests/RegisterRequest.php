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
            'last_name' => 'required|string|min:3',
            'email' => 'required|unique:users,email,' . $this->id,
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
            'avatar' => 'nullable|mimes:jpg,png,jpeg,webp|max:5048'
        ];
    }

    /**
     * @return array|void
     */
    public function messages()
    {
        return [
          'name.required' => 'Лутфан номро пур кунед!',
          'name.min' => 'Ном бояд аз 3 ҳарф зиёд бошад!',
          'last_name.required' => 'Лутфан фамилияро пур кунед!',
          'last_name.min' => 'Фамилия бояд аз 3 ҳарф зиёд бошад!',
          'email.required' => 'Email-ро пур пур кунед!',
          'email.unique' => 'Email алкай гирифта шуда аст!',
          'password.required' => 'Рамзро пур кунед!',
          'password.confirmed' => 'Рамзҳо як хела нестанд!',
          'password_confirmation.required' => 'Рамзи такрори пур кунед!',
          'avatar.mimes' => 'Лутфан акс интихоб кунед'
        ];
    }
}
