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
                'name' => 'In-Progress',
                'desc' => 'demo'
            ],
            [
                'name' => 'Closed',
                'desc' => 'demo'
            ],
            [
                'name' => 'Resolved',
                'desc' => 'demo'
            ],
            [
                'name' => 'In-Verification',
                'desc' => 'demo'
            ],
            [
                'name' => 'Ready To Verify',
                'desc' => 'demo'
            ],
            [
                'name' => 'Block',
                'desc' => 'demo'
            ],
            [
                'name' => 'Re-opened',
                'desc' => 'demo'
            ]
        ]);
    }
}
