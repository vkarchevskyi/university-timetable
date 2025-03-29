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
                'course_id' => 6,
                'day_of_week' => 1,
                'order' => 1,
                'teacher_id' => 5,
            ],
            [
                'course_id' => 6,
                'day_of_week' => 1,
                'order' => 2,
                'teacher_id' => 5,
            ],
            [
                'course_id' => 1,
                'day_of_week' => 1,
                'order' => 3,
                'teacher_id' => 1,
            ],
            [
                'course_id' => 1,
                'day_of_week' => 1,
                'order' => 4,
                'teacher_id' => 1,
            ],

            [
                'course_id' => 3,
                'day_of_week' => 2,
                'order' => 2,
                'teacher_id' => 2,
            ],
            [
                'course_id' => 2,
                'day_of_week' => 2,
                'order' => 3,
                'teacher_id' => 1,
            ],
            [
                'course_id' => 1,
                'day_of_week' => 2,
                'order' => 4,
                'teacher_id' => 1,
            ],
            [
                'course_id' => 1,
                'day_of_week' => 2,
                'order' => 5,
                'is_numerator' => true,
                'teacher_id' => 1,
            ],

            [
                'course_id' => 4,
                'day_of_week' => 3,
                'order' => 3,
                'teacher_id' => 3,
            ],
            [
                'course_id' => 4,
                'day_of_week' => 3,
                'order' => 4,
                'teacher_id' => 3,
            ],
            [
                'course_id' => 2,
                'day_of_week' => 3,
                'order' => 5,
                'teacher_id' => 1,
            ],

            [
                'course_id' => 5,
                'day_of_week' => 4,
                'order' => 1,
                'teacher_id' => 4,
            ],
            [
                'course_id' => 2,
                'day_of_week' => 4,
                'order' => 2,
                'teacher_id' => 1,
            ],
            [
                'course_id' => 5,
                'day_of_week' => 4,
                'order' => 3,
                'is_numerator' => true,
                'teacher_id' => 4,
            ],
            [
                'course_id' => 3,
                'day_of_week' => 4,
                'order' => 3,
                'is_numerator' => false,
                'teacher_id' => 2,
            ],
            [
                'course_id' => 3,
                'day_of_week' => 4,
                'order' => 4,
                'teacher_id' => 2,
            ],

            [
                'course_id' => 6,
                'day_of_week' => 5,
                'order' => 1,
                'teacher_id' => 5,
            ],
            [
                'course_id' => 6,
                'day_of_week' => 5,
                'order' => 2,
                'teacher_id' => 5,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::factory()->state($lesson)->create();
        }
    }
}
