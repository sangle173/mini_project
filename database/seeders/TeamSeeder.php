<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            [
                'name' => 'Team A',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team B',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team C',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team D',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team E',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team F',
                'desc' => 'demo'
            ],
            [
                'name' => 'Team K',
                'desc' => 'demo'
            ]
        ]);
    }
}
