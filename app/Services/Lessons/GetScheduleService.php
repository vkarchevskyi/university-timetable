<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use App\Models\Exception;
use App\Models\Lesson;
use App\ValueObjects\LessonValueObject;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

final readonly class GetScheduleService
{
    public function __construct(private IsNumeratorService $isNumerator)
    {
    }

    /**
     * @return Collection<string, Collection<int, LessonValueObject>>
     */
    public function handle(CarbonImmutable $startDate, CarbonImmutable $endDate): Collection
    {
        $exceptions = Exception::query()
            ->with(['teacher:id,name'])
            ->whereBetween('date', [$startDate->utc(), $endDate->utc()])
            ->get(['id', 'date', 'name', 'order', 'teacher_id']);

        /** @var Collection<int, Collection<int, Lesson>> $lessons */
        $lessons = Lesson::query()
            ->with(['teacher:id,name', 'course:id,name'])
            ->get(['id', 'day_of_week', 'order', 'is_numerator', 'teacher_id', 'course_id'])
            ->groupBy(fn (Lesson $lesson): int => $lesson->day_of_week->value);

        $schedule = new Collection();
        $currentDate = $startDate->startOfDay();

        while ($currentDate->lte($endDate)) {
            /** @var Collection<int, LessonValueObject> $specificDayLessons */
            $specificDayLessons = new Collection(
                ($lessons->get($currentDate->dayOfWeekIso) ?? new Collection())
                    ->filter(
                        fn (Lesson $lesson): bool => is_null($lesson->is_numerator)
                            || $lesson->is_numerator === $this->isNumerator->handle($currentDate)
                    )
                    ->map(
                        fn (Lesson $lesson): LessonValueObject => new LessonValueObject(
                            $lesson->course->name,
                            $currentDate->setTimeFromTimeString($lesson->order->getLessonStart()),
                            $lesson->order,
                            $lesson->teacher->name,
                        )
                    )
            );

            /** @var Collection<int, Exception> $specificDayExceptions */
            $specificDayExceptions = $exceptions->whereBetween('date', [$currentDate, $currentDate->endOfDay()]);

            foreach ($specificDayExceptions as $exception) {
                $lessonWithException = $specificDayLessons->search(
                    fn (LessonValueObject $lesson): bool => $lesson->datetime->equalTo(
                        $exception->date
                            ->setTimezone($lesson->datetime->timezone)
                            ->setTimeFromTimeString($exception->order->getLessonStart())
                    ),
                    true
                );

                if (false === $lessonWithException) {
                    $specificDayLessons->add($this->createLessonValueObject($exception));
                    continue;
                }

                if (empty($exception->name)) {
                    $specificDayLessons->forget($lessonWithException);
                } else {
                    $specificDayLessons->put($lessonWithException, $this->createLessonValueObject($exception));
                }
            }

            $schedule->put(
                $currentDate->format('Y-m-d'),
                $specificDayLessons->sort(
                    fn (LessonValueObject $l1, LessonValueObject $l2): int => $l1->order->value <=> $l2->order->value
                ),
            );
            $currentDate = $currentDate->addDay();
        }

        return $schedule;
    }

    private function createLessonValueObject(Exception $exception): LessonValueObject
    {
        return new LessonValueObject(
            $exception->name,
            $exception->date->setTimeFromTimeString($exception->order->getLessonStart()),
            $exception->order,
            $exception->teacher->name,
        );
    }
}
