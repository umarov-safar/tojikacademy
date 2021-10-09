<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
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
        return backpack_auth()->check();
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
            'user_id' => 'required|exists:users,id',
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
            'user_id.required' => 'Саволдиҳандаро интихоб кунед',
            'user_id.exists' => 'Истифода баранда ёфт нашуд',
            'image.mimes' => 'Формати акc бояд jpg, png, jpeg, gif, svg, webp бошад'
        ];
    }
}
