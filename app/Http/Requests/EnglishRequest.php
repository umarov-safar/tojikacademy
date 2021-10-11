<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class EnglishRequest extends FormRequest
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
            'sentence' => 'required|unique:englishes,sentence|min:5|max:255',
            'translate1' =>  'required',
            'category'  => 'required|exists:language_categories,id',
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
            'sentence.required' => 'Ибораро нависед',
            'sentence.unique' => 'Инхел ибора вуҷуд дорад',
            'sentence.min' => 'Ибора бояд аз 5 ҳарф зиёд бошад',
            'translate1.required' => 'Тарҷумаро нависед',
            'category.required' => 'Категорияро итихоб кунед',
            'category.exists' => 'Категория бояд дар таблитцаи категория вуҷуд дошта бошад'
        ];
    }
}
