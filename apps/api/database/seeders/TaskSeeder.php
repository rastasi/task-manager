<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $existingCount = Task::count();

        for ($i = 1; $i <= 10; $i++) {
            $index = $existingCount + $i;

            Task::create([
                'description' => "Task description #$index",
                'user_id' => rand(1, 2),
                'estimated_time' => rand(30, 180),
                'used_time' => rand(0, 180),
                'created_at' => now()->subDays(rand(1, 10)),
                'updated_at' => now(),
                'completed_at' => null,
            ]);
        }
    }
}
