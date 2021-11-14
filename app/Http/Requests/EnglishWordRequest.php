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
        //remove correct word in wrong words
        if($this->isMethod('PUT'))
        {
            $wordsID = $this->words;

            if(is_array($wordsID) && in_array($this->id, $wordsID))
            {
                unset($wordsID[array_search($this->id, $wordsID)]);
                $this->merge([
                    'words' => $wordsID
                ]);
            }

        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word' => 'required',
            'translate' => 'required',
            'categories' => 'required',
            'words' => 'required|array|min:2|max:2',
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
