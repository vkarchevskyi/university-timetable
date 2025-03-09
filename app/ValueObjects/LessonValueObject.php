<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Enums\LessonOrder;
use Carbon\CarbonImmutable;

final readonly class LessonValueObject
{
    public function __construct(
        public string $name,
        public CarbonImmutable $datetime,
        public LessonOrder $order,
    ) {
    }
}
