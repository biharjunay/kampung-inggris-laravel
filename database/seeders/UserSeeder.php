<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'alex',
            'email' => 'alex@test.test',
            'password' => Hash::make('testingss'),
            'role' => 'superadmin'
        ]);
    }
}
