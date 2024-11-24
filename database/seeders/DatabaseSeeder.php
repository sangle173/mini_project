<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WorkingStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->call(UserTableSeeder::class);
        $this->call(WorkingStatusSeeder::class);
        $this->call(TicketStatusSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(TypeSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
