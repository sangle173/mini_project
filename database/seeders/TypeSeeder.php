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
                'name' => 'Bug Found',
                'desc' => 'demo'
            ],
            [
                'name' => 'Testing Request',
                'desc' => 'demo'
            ],
            [
                'name' => 'Ticket Verification',
                'desc' => 'demo'
            ],
            [
                'name' => 'Bug Verification',
                'desc' => 'demo'
            ],
            [
                'name' => 'Write TestPlan',
                'desc' => 'demo'
            ],
            [
                'name' => 'Regression',
                'desc' => 'demo'
            ],
            [
                'name' => 'Automation Ticket',
                'desc' => 'demo'
            ]
        ]);
    }
}
