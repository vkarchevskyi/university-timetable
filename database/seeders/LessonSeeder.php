<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

final class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'name' => 'Основи 3D моделювання',
                'day_of_week' => 1,
                'order' => 3,
                'teacher_id' => 1,
            ],
            [
                'name' => 'Основи 3D моделювання',
                'day_of_week' => 1,
                'order' => 4,
                'teacher_id' => 1,
            ],
            [
                'name' => 'Розробка програмного забезпечення (пр)',
                'day_of_week' => 1,
                'order' => 5,
                'teacher_id' => 1,
            ],

            [
                'name' => 'Моделювання систем (л)',
                'day_of_week' => 2,
                'order' => 2,
                'teacher_id' => 2,
            ],
            [
                'name' => 'Розробка програмного забезпечення (л/пр)',
                'day_of_week' => 2,
                'order' => 3,
                'teacher_id' => 1,
            ],
            [
                'name' => 'Основи 3D моделювання',
                'day_of_week' => 2,
                'order' => 4,
                'teacher_id' => 1,
            ],
            [
                'name' => 'Основи 3D моделювання',
                'day_of_week' => 2,
                'order' => 5,
                'is_numerator' => true,
                'teacher_id' => 1,
            ],

            [
                'name' => 'Іноземна мова',
                'day_of_week' => 3,
                'order' => 3,
                'teacher_id' => 3,
            ],
            [
                'name' => 'Іноземна мова',
                'day_of_week' => 3,
                'order' => 4,
                'teacher_id' => 3,
            ],
            [
                'name' => 'Розробка програмного забезпечення (л/пр)',
                'day_of_week' => 3,
                'order' => 5,
                'teacher_id' => 1,
            ],

            [
                'name' => 'Хмарні технології (л)',
                'day_of_week' => 4,
                'order' => 1,
                'teacher_id' => 4,
            ],
            [
                'name' => 'Розробка програмного забезпечення (л/пр)',
                'day_of_week' => 4,
                'order' => 2,
                'teacher_id' => 1,
            ],
            [
                'name' => 'Хмарні технології (пр)',
                'day_of_week' => 4,
                'order' => 3,
                'is_numerator' => true,
                'teacher_id' => 4,
            ],
            [
                'name' => 'Моделювання систем (с)',
                'day_of_week' => 4,
                'order' => 3,
                'is_numerator' => false,
                'teacher_id' => 2,
            ],
            [
                'name' => 'Моделювання систем (лб)',
                'day_of_week' => 4,
                'order' => 4,
                'teacher_id' => 2,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::factory()->state($lesson)->create();
        }
    }
}
