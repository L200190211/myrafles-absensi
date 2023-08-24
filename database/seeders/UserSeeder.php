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
                'lastLogin' => now(),
                'password' => bcrypt('1234')
        ]);
      }
}