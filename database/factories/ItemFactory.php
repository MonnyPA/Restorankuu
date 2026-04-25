<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;


class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'category_id' => $this->faker->numberBetween(1, 2),
            'img' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean()
        ];
    }
}
