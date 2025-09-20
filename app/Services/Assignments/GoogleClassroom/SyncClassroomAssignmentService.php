<?php

declare(strict_types=1);

namespace App\Services\Assignments\GoogleClassroom;

use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Exceptions\Assignments\GoogleClassroom\ApiException;
use App\Models\ClassroomAssignment;
use App\Models\ClassroomCourse;
use App\Repositories\Assignments\GoogleClassroom\GoogleClassroomAssignmentsRepository;
use Carbon\CarbonImmutable;
use Illuminate\Http\Client\ConnectionException;
use JsonException;

final readonly class SyncClassroomAssignmentService
{
    public function __construct(private GoogleClassroomAssignmentsRepository $classroomAssignmentsRepository)
    {
    }

    /**
     * @throws ConnectionException
     * @throws JsonException
     * @throws ApiAuthenticationException
     * @throws ApiException
     */
    public function handle(ClassroomCourse $course): void
    {
        $assignmentData = [];
        foreach ($this->classroomAssignmentsRepository->list($course->classroom_id) as $assignment) {
            $dueDatetime = is_object($assignment->dueDate) && is_object($assignment->dueTime)
                ? new CarbonImmutable()
                    ->setDate(
                        $assignment->dueDate->year,
                        $assignment->dueDate->month,
                        $assignment->dueDate->day,
                    )
                    ->setTime(
                        $assignment->dueTime->hours,
                        $assignment->dueTime->minutes ?? 0,
                        $assignment->dueTime->seconds ?? 0,
                        $assignment->dueTime->nanos ?? 0,
                    )
                : null;

            $assignmentData[] = [
                'classroom_course_id' => $course->id,
                'title' => $assignment->title,
                'stop_date_sync' => false,
                'classroom_id' => $assignment->classroomId,
                'description' => $assignment->description,
                'materials' => json_encode($assignment->materials, JSON_THROW_ON_ERROR),
                'state' => $assignment->state,
                'alternate_link' => $assignment->alternateLink,
                'max_points' => $assignment->maxPoints,
                'due_datetime' => $dueDatetime?->format('Y-m-d H:i:s'),
                'work_type' => $assignment->workType,
                'assignee_mode' => $assignment->assigneeMode,
            ];
        }

        ClassroomAssignment::query()->upsert(
            $assignmentData,
            uniqueBy: ['classroom_id'],
            update: [
                'classroom_course_id',
                'title',
                'stop_date_sync',
                'description',
                'materials',
                'state',
                'alternate_link',
                'max_points',
                'due_datetime',
                'work_type',
                'assignee_mode',
            ]
        );
    }
}
