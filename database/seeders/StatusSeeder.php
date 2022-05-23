<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->name = 'Còn trống';
        $status->save();

        $status = new Status();
        $status->name = 'Đã thuê';
        $status->save();

        $status = new Status();
        $status->name = 'Đang nâng cấp';
        $status->save();

    }
}
