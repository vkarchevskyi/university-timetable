<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Lessons\WeekType;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
final class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
            'day_of_week' => $this->faker->randomElement([0, 1, 2, 3, 4, 5, 6]),
            'order' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'week_type' => WeekType::BOTH,
            'room_number' => 1,
        ];
    }
}
