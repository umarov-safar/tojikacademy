<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class QuestionCategoryRequest extends FormRequest
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

    /***
     * preparing slug
     */
    public function prepareForValidation()
    {
        $this->merge(
            [
                'slug' =>  $this->slug ? Str::slug($this->slug) : Str::slug($this->name),
            ]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'unique:question_categories,slug,'.$this->id,
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
            'name.required' => 'Категория бо ин ном алайкай вуҷуд дорад',
            'slug.unique' => 'Номи ягона бо ин ном вуҷуд дорад',
        ];
    }
}
