<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Lesson;
use App\Models\Exception;
use App\Enums\Shared\DayOfWeek;
use App\Enums\Lessons\LessonOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some courses
        $courses = [
            'Математичний аналіз',
            'Лінійна алгебра',
            'Програмування',
            'Фізика',
            'Англійська мова',
            'Історія України',
            'Філософія',
            'Економіка',
        ];

        foreach ($courses as $courseName) {
            Course::firstOrCreate(['name' => $courseName]);
        }

        // Create some teachers
        $teachers = [
            'Іванов Іван Іванович',
            'Петрова Марія Степанівна',
            'Сидоренко Олексій Васильович',
            'Коваленко Наталія Олександрівна',
            'Мельник Андрій Петрович',
            'Бондаренко Оксана Миколаївна',
            'Шевченко Василь Григорович',
            'Кравченко Людмила Іванівна',
        ];

        foreach ($teachers as $teacherName) {
            Teacher::firstOrCreate(['name' => $teacherName]);
        }

        // Create some lessons
        $courseIds = Course::pluck('id')->toArray();
        $teacherIds = Teacher::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Lesson::create([
                'course_id' => $courseIds[array_rand($courseIds)],
                'teacher_id' => $teacherIds[array_rand($teacherIds)],
                'day_of_week' => DayOfWeek::cases()[array_rand(DayOfWeek::cases())],
                'order' => LessonOrder::cases()[array_rand(LessonOrder::cases())],
                'is_numerator' => rand(0, 1),
            ]);
        }

        // Create some exceptions
        for ($i = 0; $i < 10; $i++) {
            Exception::create([
                'course_id' => $courseIds[array_rand($courseIds)],
                'teacher_id' => rand(0, 1) ? $teacherIds[array_rand($teacherIds)] : null,
                'date' => now()->addDays(rand(-30, 60)),
                'order' => LessonOrder::cases()[array_rand(LessonOrder::cases())],
            ]);
        }
    }
}
