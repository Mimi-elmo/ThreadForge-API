<?php

namespace Database\Factories;

use App\Models\Blueprint;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlueprintFactory extends Factory
{
    protected $model = Blueprint::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'target_audience' => fake()->words(2, true),
            'tone' => fake()->randomElement(['Professional', 'Casual', 'Humorous']),
            'max_characters' => 280,
            'max_hashtags' => 1,
            'rules' => null,
        ];
    }
}
