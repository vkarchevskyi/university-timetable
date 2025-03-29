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
                'name' => 'Основи 3D моделювання',
            ],
            [
                'name' => 'Розробка програмного забезпечення',
            ],
            [
                'name' => 'Моделювання систем',
            ],
            [
                'name' => 'Іноземна мова',
            ],
            [
                'name' => 'Хмарні технології',
            ],
            [
                'name' => 'Бізнес-аналіз в ІТ-галузі',
            ]
        ];

        foreach ($courses as $course) {
            Course::factory()->state($course)->create();
        }
    }
}
