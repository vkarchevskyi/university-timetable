<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomCourse>
 */
class ClassroomCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(1, 1000),
            'course_id' => $this->faker->numberBetween(1, 1000),
            'teacher_id' => $this->faker->numberBetween(1, 1000),
            'name' => fake()->name(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'owner_id' => $this->faker->text(),
            'classroom_id' => $this->faker->text(),
            'course_state' => $this->faker->text(),
            'alternate_link' => $this->faker->text(),
            'calendar_id' => $this->faker->text(),
        ];
    }
}
