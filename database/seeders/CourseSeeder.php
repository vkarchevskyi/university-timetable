<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

final class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Технології розробки стартапів',
            ],
            [
                'name' => 'Проектування інформаційних систем',
            ],
            [
                'name' => 'Комп\'ютерна анімація',
            ],
            [
                'name' => 'Веб-додатки React.JS',
            ],
        ];

        foreach ($courses as $course) {
            Course::factory()->state($course)->create();
        }
    }
}
