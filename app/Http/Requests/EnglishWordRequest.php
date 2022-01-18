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
        $incorrect_answers = json_decode($this->incorrect_answers, true);
        foreach ($incorrect_answers[0] as $key => $value){
            if(trim($value) == '') {
                $incorrect_answers = [];
                break;
            }
        }
        $this->merge([
            'incorrect_answers' => $incorrect_answers,
            'english' => trim($this->english)

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
            'english' => 'required|unique:english_words,english,'.$this->id,
            'tj' => 'required',
            'categories' => 'required',
            'incorrect_answers' => 'required',
            'is_noun' => 'boolean',
            'is_verb' => 'boolean',
            'is_adjective' => 'boolean',
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
            'english.required' => 'Луғатро нависед',
            'english.unique' => 'Луғат алакай сохта шудааст',
            'tj.required' => 'Тарҷумаро нависед',
            'categories.required' => 'Категория луғатро интхоб кунед',
            'incorrect_answers.required' => 'Луғатҳои нодурустро интихоб кунед',
        ];
    }
}
