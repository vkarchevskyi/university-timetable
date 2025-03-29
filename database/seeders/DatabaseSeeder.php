<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CourseSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(ExceptionSeeder::class);
    }
}
