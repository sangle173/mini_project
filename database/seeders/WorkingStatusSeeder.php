<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('working_statuses')->insert([
            [
                'board_id'=> 1,
                'name' => 'In-Progress',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Done',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Todo',
                'desc' => 'demo'
            ]
        ]);
    }
}
