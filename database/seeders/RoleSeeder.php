<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'id' => '1',
            'name' => 'superadmin', //superadmin
        ]);

        Role::firstOrCreate([
            'id' => '2',
            'name' => 'admin',  //admin
        ]);

        Role::firstOrCreate([
            'id' => '3',
            'name' => 'staff',  //spv
        ]);


    }
}