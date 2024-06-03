<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = ["Barbel", "Treadmill", "Mattras", "Dumbbell", "Bench Press"];
        return [
            'name' => $name[rand(0, sizeof($name)-1)],
        ];
    }
}
