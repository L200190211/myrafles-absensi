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
        

        $ceo = User::create([
            'id' => 3,
            'firstname' => 'Reinhard',
            'email' => 'reinhard@rafles.id',
            'username' => 'reinhard',
            'jabatan' => 'Arsitek',
            'noWa' => '888999333',
            'alamat' => 'Jl Surabaya',
            'lastLogin' => now(),
            'password' => bcrypt('1234')
        ]);
        $ceo->assignRole('superadmin');

        $jaster = User::create([
                'id' => 2,
                'firstname' => 'JasterTeam',
                'email' => 'web@jaster.co.id',
                'username' => 'jaster',
                'noWa' => '888999333',
                'jabatan' => 'Arsitek',
                'alamat' => 'Jl Surabaya',
                'lastLogin' => now(),
                'password' => bcrypt('1234')
        ]);
        $jaster->assignRole('superadmin');

        
        $admrafles = User::create([
            'id' =>1,
            'firstname' => 'Admin Rafles',
            'email' => 'admin@rafles.id',
            'username' => 'admrafles',
            'lastLogin' => now(),
            'alamat' => 'Jl Surabaya',
            'jabatan' => 'Arsitek',
            'noWa' => '888999333',
            'password' => bcrypt('1234')
        ]);

        $admrafles->assignRole('superadmin');

        
      }
}