<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\City;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'description' => $this->faker->text(),
            'bedroom' => rand(1,5),
            'bathroom' => rand(1,3),
            'category_id' => Category::all()->random()->id,
            'status_id'=>Status::all()->random()->id,
            'city_id' => City::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
