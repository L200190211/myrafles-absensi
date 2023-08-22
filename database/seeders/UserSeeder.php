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
            'firstname' => 'Admin JACO',
            'email' => 'admin@posjaco.com',
            'username' => 'admjaco',
            'lastLogin' => now(),
            'city' => 'Surabaya',
            'noWa' => '888999333',
            'password' => bcrypt('jacoidn')
        ]);

        $admjaco->assignRole('superadmin');

        $jaster = User::create([
                'id' => 2,
                'firstname' => 'JasterTeam',
                'email' => 'jaster@superadmin.com',
                'username' => 'jaster',
                'city' => 'Surabaya',
                'noWa' => '888999333',
                'lastLogin' => now(),
                'password' => bcrypt('1234')
        ]);

        $jaster->assignRole('superadmin');


        $admin = User::create([
                'id' => 3,
                'firstname' => 'Robert Admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'lastLogin' => now(),
                'city' => 'Surabaya',
                'noWa' => '888999333',
                'password' => bcrypt('1234')
        ]);

        $admin->assignRole('staff');
      }
}