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
                'title' => 'Основи 3D моделювання',
            ],
            [
                'title' => 'Розробка програмного забезпечення',
            ],
            [
                'title' => 'Моделювання систем',
            ],
            [
                'title' => 'Іноземна мова',
            ],
            [
                'title' => 'Хмарні технології',
            ],
            [
                'title' => 'Бізнес-аналіз в ІТ-галузі',
            ]
        ];

        foreach ($courses as $course) {
            Course::factory()->state($course)->create();
        }
    }
}
