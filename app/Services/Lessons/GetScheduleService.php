<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use App\Enums\Lessons\WeekType;
use App\Models\Exception;
use App\Models\Lesson;
use App\ValueObjects\LessonValueObject;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use RuntimeException;

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
        $exceptions = $this->getExceptionsWithinPeriod($startDate, $endDate);
        $lessons = $this->getGroupedLessons();

        $schedule = new Collection();
        $currentDate = $startDate->startOfDay();

        while ($currentDate->lte($endDate)) {
            /** @var Collection<int, LessonValueObject> $specificDayLessons */
            $specificDayLessons = new Collection(
                ($lessons->get($currentDate->dayOfWeekIso) ?? new Collection())
                    ->filter(
                        fn (Lesson $lesson): bool => $lesson->week_type === WeekType::BOTH
                            || $lesson->week_type->isNumerator() === $this->isNumerator->handle($currentDate)
                    )
                    ->map(
                        fn (Lesson $lesson): LessonValueObject => new LessonValueObject(
                            $lesson->course->name,
                            $currentDate->setTimeFromTimeString($lesson->order->getLessonStart()),
                            $lesson->order,
                            $lesson->teacher->name,
                            $lesson->room_number,
                        )
                    )
            );

            /** @var Collection<int, Exception> $specificDayExceptions */
            $specificDayExceptions = $exceptions->whereBetween('date', [$currentDate, $currentDate->endOfDay()]);

            foreach ($specificDayExceptions as $exception) {
                /** @var int|false $lessonWithException */
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

                if (is_null($exception->course_id)) {
                    $specificDayLessons->offsetUnset($lessonWithException);
                } else {
                    $specificDayLessons->put($lessonWithException, $this->createLessonValueObject($exception));
                }
            }

            $schedule->put(
                $currentDate->format('Y-m-d'),
                $specificDayLessons->sort(LessonValueObject::getOrderComparator())
            );
            $currentDate = $currentDate->addDay();
        }

        return $schedule;
    }

    /**
     * @return Collection<int, Exception>
     */
    private function getExceptionsWithinPeriod(CarbonImmutable $startDate, CarbonImmutable $endDate): Collection
    {
        return Exception::query()
            ->with(['teacher:id,name', 'course:id,name'])
            ->whereBetween('date', [$startDate->utc(), $endDate->utc()])
            ->get(['id', 'date', 'order', 'teacher_id', 'course_id', 'room_number']);
    }

    /**
     * @return Collection<int, EloquentCollection<int, Lesson>>
     */
    private function getGroupedLessons(): Collection
    {
        return Lesson::query()
            ->with(['teacher:id,name', 'course:id,name'])
            ->get(['id', 'day_of_week', 'order', 'week_type', 'teacher_id', 'course_id', 'room_number'])
            ->groupBy(fn (Lesson $lesson): int => $lesson->day_of_week->value);
    }

    private function createLessonValueObject(Exception $exception): LessonValueObject
    {
        $courseName = $exception->course?->name;
        $teacherName = $exception->teacher?->name;

        if (is_null($courseName) || is_null($teacherName)) {
            throw new RuntimeException("Exception with id = $exception->id doesn't belong to course or teacher");
        }

        return new LessonValueObject(
            $courseName,
            $exception->date->setTimeFromTimeString($exception->order->getLessonStart()),
            $exception->order,
            $teacherName,
            $exception->room_number,
        );
    }
}
