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
                'date' => '2025-03-11',
                'name' => 'Основи 3D моделювання',
                'order' => 2,
            ],
            [
                'date' => '2025-03-13',
                'name' => 'Основи 3D моделювання',
                'order' => 1,
            ],
            [
                'date' => '2025-03-13',
                'name' => 'Основи 3D моделювання',
                'order' => 4,
            ],

            [
                'date' => '2025-03-17',
                'name' => 'Моделювання систем',
                'order' => 3,
            ],
            [
                'date' => '2025-03-17',
                'name' => 'Хмарні технології',
                'order' => 4,
            ],
            [
                'date' => '2025-03-17',
                'name' => null,
                'order' => 5,
            ],

            [
                'date' => '2025-03-18',
                'name' => 'Моделювання систем',
                'order' => 3,
            ],
            [
                'date' => '2025-03-18',
                'name' => 'Хмарні технології',
                'order' => 4,
            ],
            [
                'date' => '2025-03-18',
                'name' => null,
                'order' => 5,
            ],

            [
                'date' => '2025-03-19',
                'name' => null,
                'order' => 5,
            ],

            [
                'date' => '2025-03-20',
                'name' => 'Хмарні технології',
                'order' => 2,
            ],
        ];

        foreach ($exceptions as $exception) {
            Exception::factory()->state($exception)->create();
        }
    }
}
