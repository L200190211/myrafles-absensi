<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        
        $admjaco = User::create([
            'id' =>1,
            'name' => 'Admin JACO',
            'email' => 'admin@posjaco.com',
            'usrn' => 'admjaco',
            'lastLogin' => now(),
            'kota' => 'Surabaya',
            'noWa' => '888999333',
            'password' => bcrypt('jacoidn')
        ]);

        $admjaco->assignRole('superadmin');

        $jaster = User::create([
                'id' => 2,
                'name' => 'JasterTeam',
                'email' => 'jaster@superadmin.com',
                'usrn' => 'jaster',
                'kota' => 'Surabaya',
                'noWa' => '888999333',
                'lastLogin' => now(),
                'password' => bcrypt('1234')
        ]);

        $jaster->assignRole('superadmin');


        $admin = User::create([
                'id' => 3,
                'name' => 'Robert Admin',
                'email' => 'admin@admin.com',
                'usrn' => 'admin',
                'lastLogin' => now(),
                'kota' => 'Surabaya',
                'noWa' => '888999333',
                'password' => bcrypt('1234')
        ]);

        $admin->assignRole('staff');
      }
}