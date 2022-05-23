<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $city = new City();
        $city->name = "Hà Nội";
        $city->save();

        $city = new City();
        $city->name = "Hồ Chí Minh";
        $city->save();

        $city = new City();
        $city->name = "Đà Nẵng";
        $city->save();

        $city = new City();
        $city->name = "Huế";
        $city->save();

        $city = new City();
        $city->name = "Đà Lạt";
        $city->save();
    }
}
