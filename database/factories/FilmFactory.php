<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'genre' => fake()->name(),
            'rating' => 5,
            'country' => fake()->country(),
            'description' => fake()->text(200),
            'release_date' => fake()->date(),
            'ticket_price' => 200.00,
        ];
    }
}
