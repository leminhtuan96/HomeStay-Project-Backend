<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition()
    {
        return [
            'room_id' => Room::all()->random()->id,
            'image' => $this->faker->text(),
        ];
    }
}
