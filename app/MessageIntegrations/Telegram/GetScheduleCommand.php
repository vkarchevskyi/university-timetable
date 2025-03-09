<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram;

use App\Enums\DayOfWeek;
use App\Services\Lessons\GetCurrentDateService;
use App\Services\Lessons\GetScheduleService;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use App\Services\Lessons\Telegram\FormatOrderTimeService;
use App\ValueObjects\LessonValueObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Telegram\Bot\Commands\Command;

final class GetScheduleCommand extends Command
{
    protected string $name = 's';

    protected string $description = 'Отримати розклад';

    public function __construct(
        private readonly GetCurrentDateService $currentDateService,
        private readonly FormatOrderTimeService $formatOrderTimeService,
        private readonly EscapeCharactersService $escapeCharactersService,
        private readonly GetScheduleService $getScheduleService,
    ) {
    }

    public function handle(): void
    {
        $startDate = $this->currentDateService->handle();

        $lessons = $this->getScheduleService->handle($startDate->toImmutable(), $startDate->endOfWeek()->toImmutable())
            ->filter(fn (Collection $lessons): bool => $lessons->isNotEmpty())
            ->map(
                fn (Collection $lessons): string => $lessons
                    ->map(
                        fn (LessonValueObject $lesson): string => sprintf(
                            '%s %s',
                            $this->formatOrderTimeService->handle($lesson->order),
                            $lesson->name,
                        )
                    )
                    ->implode("\n")
            )
            ->implode(function (string $item, string $key) use ($startDate) {
                $dateTime = Date::createFromFormat('Y-m-d', $key);

                return sprintf(
                    "%s (%s) \n%s\n\n",
                    DayOfWeek::from($dateTime->dayOfWeekIso)->getLabel(),
                    $dateTime->format('d.m'),
                    $item
                );
            });

        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle($lessons),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
