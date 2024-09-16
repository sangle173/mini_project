<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin

            [
                'name' => 'Sang Le',
                'username' => 'sang.le',
                'email' => 'sang.le@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'manager',
                'status' => '1',
            ],
                // Instructor
            [
                'name' => 'Manager',
                'username' => 'users',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'manager',
                'status' => '1',
            ],
                // User Data
            [
                'name' => 'Tai Ngo',
                'username' => 'tai.ngo',
                'email' => 'tai.ngo@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'Hieu Tran',
                'username' => 'hieu.tran',
                'email' => 'hieu.tran@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => '1',
            ],
            [
                'name' => 'An Duong',
                'username' => 'an.duong',
                'email' => 'an.duong@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => '1',
            ],

        ]);
    }
}
