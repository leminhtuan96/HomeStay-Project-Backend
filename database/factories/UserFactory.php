<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->name(),
            'fullname'=> $this->faker->name(),
            'avatar' => $this->faker->text(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(123123),
            'role_id' => Role::all()->random()->id,
        ];
    }
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
