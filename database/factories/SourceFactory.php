<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => rand(1,5),
            'name' => $this->faker->text(10),
            'text' => $this->faker->realText(500)
        ];
    }
}
