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
                'name' => 'Віртуальна та доповнена реальність',
            ],
            [
                'name' => 'Управління IT-проектами',
            ],
            [
                'name' => 'Програмування веб-додатків LARAVEL',
            ],
            [
                'name' => 'Системний аналіз',
            ],
            [
                'name' => 'Розробка мобільних додатків',
            ],
            [
                'name' => 'Паралельні та розподіленні обчислення',
            ],
            [
                'name' => 'Проектування інформаційних систем',
            ],
        ];

        foreach ($courses as $course) {
            Course::factory()->state($course)->create();
        }
    }
}
