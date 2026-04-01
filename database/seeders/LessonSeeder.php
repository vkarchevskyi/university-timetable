<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Lessons\WeekType;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

final class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::query()->pluck('id', 'name');
        $courses = Course::query()->pluck('id', 'name');

        $lessons = [
            [
                'course_id' => $courses->get('Технології розробки стартапів'),
                'day_of_week' => 1,
                'order' => 3,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Ізвалов О.В.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Технології розробки стартапів'),
                'day_of_week' => 1,
                'order' => 4,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Ізвалов О.В.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Проектування інформаційних систем'),
                'day_of_week' => 1,
                'order' => 5,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Баранюк О.Ф.'),
                'room_number' => 16,
            ],

            [
                'course_id' => $courses->get('Комп\'ютерна анімація'),
                'day_of_week' => 2,
                'order' => 5,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Васильєва В.М.'),
                'room_number' => 9,
            ],
            [
                'course_id' => $courses->get('Проектування інформаційних систем'),
                'day_of_week' => 2,
                'order' => 6,
                'week_type' => WeekType::DENOMINATOR,
                'teacher_id' => $teachers->get('Баранюк О.Ф.'),
                'room_number' => 10,
            ],

            [
                'course_id' => $courses->get('Веб-додатки React.JS'),
                'day_of_week' => 3,
                'order' => 4,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Сурков К.Ю.'),
                'room_number' => 9,
            ],
            [
                'course_id' => $courses->get('Веб-додатки React.JS'),
                'day_of_week' => 3,
                'order' => 5,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Сурков К.Ю.'),
                'room_number' => 10,
            ],
            [
                'course_id' => $courses->get('Веб-додатки React.JS'),
                'day_of_week' => 3,
                'order' => 6,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Сурков К.Ю.'),
                'room_number' => 10,
            ],

            [
                'course_id' => $courses->get('Комп\'ютерна анімація'),
                'day_of_week' => 4,
                'order' => 2,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Васильєва В.М.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Технології розробки стартапів'),
                'day_of_week' => 4,
                'order' => 3,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Ізвалов О.В.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Технології розробки стартапів'),
                'day_of_week' => 4,
                'order' => 4,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Ізвалов О.В.'),
                'room_number' => 2,
            ],

            [
                'course_id' => $courses->get('Комп\'ютерна анімація'),
                'day_of_week' => 5,
                'order' => 1,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Васильєва В.М.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Комп\'ютерна анімація'),
                'day_of_week' => 5,
                'order' => 2,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Васильєва В.М.'),
                'room_number' => 2,
            ],
            [
                'course_id' => $courses->get('Веб-додатки React.JS'),
                'day_of_week' => 5,
                'order' => 3,
                'week_type' => WeekType::BOTH,
                'teacher_id' => $teachers->get('Сурков К.Ю.'),
                'room_number' => 2,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::factory()->state($lesson)->create();
        }
    }
}
