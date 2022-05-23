<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = new Role;
        $role->name='admin';
        $role->save();

        $role = new Role;
        $role->name='host';
        $role->save();

        $role = new Role;
        $role->name='user';
        $role->save();


    }
}
