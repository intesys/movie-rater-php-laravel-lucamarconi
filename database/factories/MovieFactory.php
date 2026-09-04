<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => rtrim($this->faker->sentence(3), '.'),
            'release_year' => $this->faker->numberBetween(1970, 2026),
            'director' => $this->faker->name(),
            'cast' => [
                $this->faker->name(),
                $this->faker->name(),
                $this->faker->name(),
            ],
            'genre' => $this->faker->randomElement([
                'Azione', 'Commedia', 'Drammatico', 'Fantascienza', 'Horror', 'Thriller'
            ]),
            'plot' => $this->faker->paragraph(),
        ];
    }
}
