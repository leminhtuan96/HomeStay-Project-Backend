<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id'=>User::all()->random()->id,
            'room_id'=>Room::all()->random()->id,
            'comments' =>$this->faker->text(),
            
        ];
    }
}
