<?php

declare(strict_types=1);

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
}
