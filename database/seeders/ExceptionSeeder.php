<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Exception;
use Illuminate\Database\Seeder;

final class ExceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exceptions = [
            [
                'date' => '2025-03-31',
                'course_id' => null,
                'order' => 1,
                'teacher_id' => null,
            ],
            [
                'date' => '2025-03-31',
                'course_id' => null,
                'order' => 2,
                'teacher_id' => null,
            ],
            [
                'date' => '2025-03-31',
                'course_id' => 5,
                'order' => 3,
                'teacher_id' => 4,
            ],
            [
                'date' => '2025-03-31',
                'course_id' => 5,
                'order' => 4,
                'teacher_id' => 4,
            ],

            [
                'date' => '2025-04-01',
                'course_id' => 4,
                'order' => 2,
                'teacher_id' => 3,
            ],
            [
                'date' => '2025-04-01',
                'course_id' => 3,
                'order' => 3,
                'teacher_id' => 2,
            ],
            [
                'date' => '2025-04-01',
                'course_id' => null,
                'order' => 4,
                'teacher_id' => null,
            ],
            [
                'date' => '2025-04-01',
                'course_id' => null,
                'order' => 5,
                'teacher_id' => null,
            ],

            [
                'date' => '2025-04-02',
                'course_id' => null,
                'order' => 3,
                'teacher_id' => null,
            ],
            [
                'date' => '2025-04-02',
                'course_id' => null,
                'order' => 4,
                'teacher_id' => null,
            ],
            [
                'date' => '2025-04-02',
                'course_id' => null,
                'order' => 5,
                'teacher_id' => null,
            ],

            [
                'date' => '2025-04-03',
                'course_id' => 3,
                'order' => 2,
                'teacher_id' => 2,
            ]
        ];

        foreach ($exceptions as $exception) {
            Exception::factory()->state($exception)->create();
        }
    }
}
