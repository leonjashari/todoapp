<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed urgent task
        Todo::create([
            'title' => 'Urgent Task',
            'description' => 'This is an urgent task.',
            'group' => 1,
            'urgent' => true,
        ]);

        // You can seed other tasks here if needed
    }
}