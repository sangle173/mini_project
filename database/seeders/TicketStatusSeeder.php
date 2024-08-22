<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_statuses')->insert([
            [
                'board_id'=> 1,
                'name' => 'In-Progress',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Closed',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Resolved',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'In-Verification',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Ready To Verify',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Block',
                'desc' => 'demo'
            ],
            [
                'board_id'=> 1,
                'name' => 'Re-opened',
                'desc' => 'demo'
            ]
        ]);
    }
}
