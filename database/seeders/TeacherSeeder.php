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
                'name' => 'Зєнов Д.О.',
            ],
            [
                'name' => 'Сурков К.Ю.',
            ],
            [
                'name' => 'Бондар О.П.',
            ],
            [
                'name' => 'Неділько В.М.',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::factory()->state($teacher)->create();
        }
    }
}
