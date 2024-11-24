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
                'name' => 'Critical',
                'desc' => 'demo'
            ],
            [
                'name' => 'Minor',
                'desc' => 'demo'
            ],
            [
                'name' => 'Major',
                'desc' => 'demo'
            ],
            [
                'name' => 'Hight',
                'desc' => 'demo'
            ],
            [
                'name' => 'Medium',
                'desc' => 'demo'
            ],
            [
                'name' => 'Low',
                'desc' => 'demo'
            ]
        ]);
    }
}
