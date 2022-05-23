<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $category = new Category;
        $category->name = 'Phòng đôi';
        $category->price = '600';
        $category->save();

        $category = new Category;
        $category->name = 'Phòng đơn';
        $category->price = '500';
        $category->save();

        $category = new Category;
        $category->name = 'Phòng tổng thống';
        $category->price = '1000';
        $category->save();

        $category = new Category;
        $category->name = 'Phòng VIP';
        $category->price = '1200';
        $category->save();


        $category = new Category;
        $category->name = 'Phòng Luxury';
        $category->price = '5500';
        $category->save();
    }
}
