<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram;

use App\Enums\DayOfWeek;
use App\Services\Lessons\GetScheduleService;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use App\Services\Lessons\Telegram\FormatOrderTimeService;
use App\Services\Lessons\Telegram\GuessDatePeriodService;
use App\ValueObjects\LessonValueObject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Telegram\Bot\Commands\Command;

final class GetScheduleCommand extends Command
{
    protected string $name = 'schedule';

    protected array $aliases = ['s'];

    protected string $pattern = '{query}';

    protected string $description = 'Отримати розклад';

    public function __construct(
        private readonly GuessDatePeriodService $guessDatePeriodService,
        private readonly FormatOrderTimeService $formatOrderTimeService,
        private readonly EscapeCharactersService $escapeCharactersService,
        private readonly GetScheduleService $getScheduleService,
    ) {
    }

    public function handle(): void
    {
        $dateQuery = $this->argument('query');
        $dates = $this->guessDatePeriodService->handle($dateQuery);

        $lessons = $this->getScheduleService->handle($dates['start'], $dates['end'])
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
            ->implode($this->concatMultipleDaysService->handle(...));

        $text = $this->escapeCharactersService->handle($lessons);

        $this->replyWithMessage([
            'text' => empty($text) ? 'На цей період не виявлено жодних пар\\. Відпочивай\\!' : $text,
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
