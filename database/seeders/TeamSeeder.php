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
                'board_id'=> 1,
                'name' => 'Team A',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team B',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team C',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team D',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team E',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team F',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Team K',
                'desc' => 'demo'
            ]
        ]);
    }
}
