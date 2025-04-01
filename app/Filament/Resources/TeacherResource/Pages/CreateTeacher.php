<?php

declare(strict_types=1);

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
}
