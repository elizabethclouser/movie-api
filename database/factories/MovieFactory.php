<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\MovieFormat;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'          => $this->faker->name,
            'format'         => $this->faker->randomElement([MovieFormat::VHS, MovieFormat::DVD, MovieFormat::STREAMING]),
            'length_minutes' => $this->faker->numberBetween(0, 500),
            'release_year'   => $this->faker->numberBetween(1800, 2100),
            'rating'         => $this->faker->numberBetween(1, 5),
        ];
    }
}
