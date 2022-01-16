<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => 'required|min:3',
            'contact' => 'required',
            'message' => 'required',
        ];
    }

    /**
     * Message of require!
     * @return string[]
     */
    public function messages()
    {
        return [
          'name.required' => 'Номатонро нависде!',
          'contact.required' => 'Номерои телефонатонро ё email-ро нависед',
          'message.required' => 'Паёматонро нависед!',
        ];
    }
}
