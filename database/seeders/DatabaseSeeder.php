<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);
        DB::table('users')->insert([
            'username' => 'jaster',
            'firstname' => 'Jasterweb',
            'email' => 'web@jaster.co.id',
            'password' => bcrypt('1234')]);

        DB::table('users')->insert([
            'username' => 'rafles',
            'firstname' => 'rafles',
            'email' => 'rafles@rafles.m',
            'password' => bcrypt('1234')]);
       
    }
}
