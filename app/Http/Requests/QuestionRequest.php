<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return true;
    }


    protected function prepareForValidation()
    {
        $this->merge([
           'slug' => \Str::slug($this->title)
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
            'title' => 'required|min:5',
            'category' => 'required|exists:question_categories,id',
            'slug' => 'required|unique:questions,user_id,' . auth()->user()->id
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
            'title.required' => 'Лутфан саволро нависед',
            'title.min' => 'Савол бояд аз 5 ҳарф зиёд бошад',
            'category.required' => 'Категорияи саволро итихоб кунед',
            'category.exists' => 'Категория ёфт нашуд. Категория дурустро интихоб кунед',
        ];
    }
}
