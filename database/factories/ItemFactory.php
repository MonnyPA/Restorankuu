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
            'img' => fake()->randomElement(
                [
                    'https://plus.unsplash.com/premium_photo-1694670234085-4f38b261ce5b'.
                    'https://plus.unsplash.com/premium_photo-1694547926001-f2151e4a476b',
                    'https://images.unsplash.com/photo-1591325418441-ff678baf78ef',
                    'https://images.unsplash.com/photo-1638866281450-3933540af86a'
                ]),
            'is_active' => $this->faker->boolean()
        ];
    }
}
