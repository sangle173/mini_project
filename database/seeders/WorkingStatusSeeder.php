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
                'name' => 'In-Progress',
                'desc' => 'demo'
            ],
            [
                'name' => 'Done',
                'desc' => 'demo'
            ]
        ]);
    }
}
