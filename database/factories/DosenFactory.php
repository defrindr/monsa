<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'nip' => $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $name,
            'user_id' => function () use ($name) {
                return User::factory()->create([
                    'name' => $name
                ])->id;
            },
        ];
    }
}
