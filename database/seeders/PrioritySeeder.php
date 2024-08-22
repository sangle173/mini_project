<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priorities')->insert([
            [
                'board_id'=> 1,
                'name' => 'Critical',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Minor',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Major',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Hight',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Medium',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Low',
                'desc' => 'demo'
            ]
        ]);
    }
}
