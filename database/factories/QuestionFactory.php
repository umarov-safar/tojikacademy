<?php

namespace Database\Factories;

use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->randomHtml(),
            'slug' => $this->faker->slug(),
            'question_category_id' => QuestionCategory::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
