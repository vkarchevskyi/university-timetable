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
                'name' => 'Баранюк О.Ф.',
            ],
            [
                'name' => 'Васильєва В.М.',
            ],
            [
                'name' => 'Сурков К.Ю.',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::factory()->state($teacher)->create();
        }
    }
}
