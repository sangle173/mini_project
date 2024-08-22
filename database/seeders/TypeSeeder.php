<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'board_id'=> 1,
                'name' => 'Bug Found',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Testing Request',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Ticket Verification',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Bug Verification',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Write TestPlan',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Regression',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Automation Ticket',
                'desc' => 'demo'
            ]
        ]);
    }
}
