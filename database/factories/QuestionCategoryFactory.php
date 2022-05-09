<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        id	name	slug	image	description	created_at	updated_at
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->sentence()
        ];
    }
}
