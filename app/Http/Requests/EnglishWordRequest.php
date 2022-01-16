<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class EnglishWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'incorrect_answers' => json_decode($this->incorrect_answers, true)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'english' => 'required',
            'tj' => 'required',
            'categories' => 'required',
            'incorrect_answers' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'word.required' => 'Луғатро нависед',
            'translate.required' => 'Тарҷумаро нависед',
            'categories.required' => 'Категория луғатро интхоб кунед',
            'words.required' => 'Луғатҳои нодурустро интихоб кунед',
        ];
    }
}
