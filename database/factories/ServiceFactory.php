<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'name' => ucfirst($name),
            'slug_name' => Str::slug($name),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'duration' => $this->faker->randomElement([30, 45, 60, 90, 120]),
            'is_active' => $this->faker->boolean(90),
            'settings' => json_encode([
                'custom_field' => $this->faker->word(),
                'additional_info' => $this->faker->sentence(),
            ]),
        ];
    }
}
