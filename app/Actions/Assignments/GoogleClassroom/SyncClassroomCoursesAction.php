<?php

declare(strict_types=1);

namespace App\Actions\Assignments\GoogleClassroom;

use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Exceptions\Assignments\GoogleClassroom\ApiException;
use App\Models\ClassroomCourse;
use App\Repositories\Assignments\GoogleClassroom\GoogleClassroomCoursesRepository;
use Illuminate\Http\Client\ConnectionException;
use JsonException;

final readonly class SyncClassroomCoursesAction
{
    public function __construct(private GoogleClassroomCoursesRepository $classroomCoursesRepository)
    {
    }

    /**
     * @throws ConnectionException
     * @throws JsonException
     * @throws ApiAuthenticationException
     * @throws ApiException
     */
    public function handle(): void
    {
        $coursesData = [];
        foreach ($this->classroomCoursesRepository->list() as $course) {
            $coursesData[] = [
                'classroom_id' => $course->classroomId,
                'name' => $course->name,
                'owner_id' => $course->ownerId,
                'course_state' => $course->courseState,
                'alternate_link' => $course->alternateLink,
                'calendar_id' => $course->calendarId,
            ];
        }

        ClassroomCourse::query()->upsert(
            $coursesData,
            uniqueBy: ['classroom_id'],
            update: ['name', 'owner_id', 'course_state', 'alternate_link', 'calendar_id']
        );
    }
}
