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
        

        
        $admrafles = User::create([
            'id' =>1,
            'firstname' => 'Admin Rafles',
            'email' => 'admin@rafles.id',
            'username' => 'admrafles',
            'lastLogin' => now(),
            'city' => 'Surabaya',
            'alamat' => 'Surabaya',
            'jabatan' => 'Arsitek',
            'noWa' => '888999333',
            'password' => bcrypt('1234')
        ]);

        $admrafles->assignRole('superadmin');

        $jaster = User::create([
                'id' => 2,
                'firstname' => 'JasterTeam',
                'email' => 'jaster@jaster.co.id',
                'username' => 'jaster',
                'city' => 'Surabaya',
                'noWa' => '888999333',
                'jabatan' => 'Arsitek',
                'alamat' => 'Surabaya',
                'lastLogin' => now(),
                'password' => bcrypt('1234')
        ]);
        $jaster->assignRole('superadmin');


        $admin = User::create([
            'id' => 3,
            'firstname' => 'admin',
            'email' => 'admin@admin.co.id',
            'username' => 'admin',
            'city' => 'Surabaya',
            'jabatan' => 'Arsitek',
            'noWa' => '888999333',
            'alamat' => 'Surabaya',
            'lastLogin' => now(),
            'password' => bcrypt('1234')
        ]);
        $admin->assignRole('admin');

        $staff = User::create([
            'id' => 4,
            'firstname' => 'staff',
            'email' => 'staff@staff.co.id',
            'username' => 'staff',
            'city' => 'Surabaya',
            'alamat' => 'Surabaya',
            'jabatan' => 'Arsitek',
            'noWa' => '888999333',
            'lastLogin' => now(),
            'password' => bcrypt('1234')
        ]);
        $staff->assignRole('staff');
      }
}