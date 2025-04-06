<?php

declare(strict_types=1);

namespace App\ValueObjects;

use App\Enums\Lessons\LessonOrder;
use Carbon\CarbonImmutable;
use Closure;

final readonly class LessonValueObject
{
    public function __construct(
        public string $name,
        public CarbonImmutable $datetime,
        public LessonOrder $order,
        public string $teacherName,
    ) {
    }

    public static function getOrderComparator(): Closure
    {
        return fn (LessonValueObject $l1, LessonValueObject $l2): int => $l1->order->value <=> $l2->order->value;
    }
}
