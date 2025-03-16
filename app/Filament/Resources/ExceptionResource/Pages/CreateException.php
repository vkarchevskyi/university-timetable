<?php

declare(strict_types=1);

namespace App\Filament\Resources\ExceptionResource\Pages;

use App\Filament\Resources\ExceptionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateException extends CreateRecord
{
    protected static string $resource = ExceptionResource::class;
}
