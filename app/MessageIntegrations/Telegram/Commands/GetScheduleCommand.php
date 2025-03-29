<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\MessageIntegrations\Telegram\Formats\Lessons\NameLessonMessageFormat;
use App\MessageIntegrations\Telegram\Formats\Lessons\LessonsMessageFormatStrategy;
use App\MessageIntegrations\Telegram\Formats\Lessons\OrderLessonsMessageFormat;
use App\MessageIntegrations\Telegram\Formats\Lessons\TeacherNameLessonMessageFormat;
use App\MessageIntegrations\Telegram\Formats\Lessons\TimeLessonsMessageFormat;
use App\Services\Lessons\GetScheduleService;
use App\Services\Lessons\Telegram\ConcatMultipleDaysService;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use App\Services\Lessons\Telegram\FormatLessonMessageService;
use App\Services\Lessons\Telegram\GuessDatePeriodService;
use App\ValueObjects\LessonValueObject;
use Illuminate\Support\Collection;
use Telegram\Bot\Commands\Command;

final class GetScheduleCommand extends Command
{
    protected string $name = 'schedule';

    protected array $aliases = [
        's',
        'st',
        'stt',
    ];

    protected string $description = 'Отримати розклад. Також є скорочення /s, /st та /stt для отримання розкладу, розкладу з часом та розкладу з часом та викладачами';

    public function __construct(
        private readonly ConcatMultipleDaysService $concatMultipleDaysService,
        private readonly GuessDatePeriodService $guessDatePeriodService,
        private readonly FormatLessonMessageService $formatLessonMessageService,
        private readonly EscapeCharactersService $escapeCharactersService,
        private readonly GetScheduleService $getScheduleService,
    ) {
    }

    public function handle(): void
    {
        $text = $this->getUpdate()->getMessage()->get('text', '');
        $textParts = explode(' ', $text, 2);

        $messageStrategies = $this->getFormatStrategies($textParts[0]);
        $period = $this->guessDatePeriodService->handle($textParts[1] ?? null);

        $lessons = $this->getScheduleService->handle($period->start, $period->end)
            ->filter(fn (Collection $lessons): bool => $lessons->isNotEmpty())
            ->map(
                fn (Collection $lessons): string => $lessons
                    ->map(
                        fn (LessonValueObject $lesson): string => $this->formatLessonMessageService->handle(
                            $messageStrategies,
                            $lesson
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

    /**
     * @return LessonsMessageFormatStrategy[]
     */
    private function getFormatStrategies(string $command): array
    {
        $strategies = [
            new OrderLessonsMessageFormat(),
        ];

        if (str_contains($command, '/st')) {
            $strategies[] = new TimeLessonsMessageFormat();
        }

        $strategies[] = new NameLessonMessageFormat();

        if (str_contains($command, '/stt')) {
            $strategies[] = new TeacherNameLessonMessageFormat();
        }

        return $strategies;
    }
}
