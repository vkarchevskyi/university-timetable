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
                'order' => 4,
            ],
        ];

        foreach ($exceptions as $exception) {
            Exception::factory()->state($exception)->create();
        }
    }
}
