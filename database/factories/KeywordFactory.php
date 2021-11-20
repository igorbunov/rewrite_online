<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KeywordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $needed = rand(1, 3);

        return [
            'project_id' => rand(1,5),
            'name' => $this->faker->text(10),
            'needed' => $needed,
            'applied' => rand(0, $needed)
        ];
    }
}
