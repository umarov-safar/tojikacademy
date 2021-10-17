<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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


    public function prepareForValidation()
    {
        $answers = json_decode($this->answers);


        //if answer is one
        if(count($answers) == 1){
            $this->merge([
                'answers' => false
            ]);

            return null;
        }
        /**
         * check is there any correct answer and for determine the quiz has many answer or one
         * int $correctAnswer
        */
        $correctAnswer = 0;

         /**
         * check if answer field is empty
         * int $emptyAnswer
         */
        $emptyAnswer = 0;

        //looping all answers to determine is there any empty answer field or correct answer
        foreach($answers as $answer) {
            if($answer->is_true) $correctAnswer++;
            if(!$answer->answer && $answer->answer == '') $emptyAnswer++;
         }

        //if is any empty answer field then will change type of answer field for validation
        if($emptyAnswer > 0)
        {
            $this->merge([
                'answers' => false
            ]);
        }

        //if did not choice any correct answer  then will change type of answer field for validation
        if($correctAnswer == 0) {
            $this->merge([
                'answers' => false
            ]);
        }

        //if correct answer is more than 1, then must be checked the more answer
        $moreAnswer = (bool) $this->more_answer;
        if($correctAnswer > 1 && !$this->more_answer)
        {
            $this->merge([
                'more_answer' => 'string'
            ]);
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
            'quiz' => 'required|string|min:5',
            'answers' => 'required|string',
            'more_answer' => 'required|boolean',
            'category' => 'required|exists:quiz_categories,id'
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
            'quiz.required' => 'Тестро нависед',
            'answers.string' => 'Лутфан ҷавобҳоро пур кунед ва як ҷавоби дуруст ё зиёд интихоб кунед!',
            'more_answer.boolean' => 'Зиёда аз ду ҷавоб доред лутфан (More answer)-ро тик гузоред',
            'category.required' => 'Категорияро интихоб кунед'
        ];
    }
}
