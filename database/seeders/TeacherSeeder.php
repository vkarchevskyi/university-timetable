<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

final class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Ізвалов О.В.',
            ],
            [
                'name' => 'Паращук С.Д.',
            ],
            [
                'name' => 'Максимова О.П.',
            ],
            [
                'name' => 'Сурков К.Ю.',
            ],
            [
                'name' => 'Васильковська Ж.В.',
            ]
        ];

        foreach ($teachers as $teacher) {
            Teacher::factory()->state($teacher)->create();
        }
    }
}
