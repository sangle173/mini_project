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
                'name' => 'Content Experience',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Initial Configuration',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'App Core',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Playback Control',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Pinewood',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Home Audio Embedded',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Networking',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Playback Control',
                'desc' => 'demo'
            ]
        ]);
    }
}
