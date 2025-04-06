<?php

declare(strict_types=1);

namespace App\Repositories\Assignments\GoogleClassroom;

use App\DataTransferObjects\Assignments\GoogleClassroom\AssignmentData;
use App\DataTransferObjects\Assignments\GoogleClassroom\CourseData;
use App\Enums\Assignments\GoogleClassroom\CourseWorkState;
use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Exceptions\Assignments\GoogleClassroom\ApiException;
use Illuminate\Http\Client\ConnectionException;
use JsonException;

final readonly class GoogleClassroomAssignmentsRepository extends AbstractGoogleClassroomRepository
{
    /**
     * @throws ConnectionException
     * @throws JsonException
     * @throws ApiAuthenticationException
     * @throws ApiException
     */
    public function list(string $courseId): array
    {
        $user = $this->getUser();

        $response = $this->http
            ->withToken($user->google_token)
            ->withQueryParameters([
                'courseWorkStates' => [CourseWorkState::PUBLISHED->value]
            ])
            ->get("https://classroom.googleapis.com/v1/courses/{$courseId}/courseWork");

        $this->checkResponseStatus($response);

        /** @var array<int, object> $assignmentsData */
        $assignmentsData = json_decode($response->body(), flags: JSON_THROW_ON_ERROR)->courseWork;
        /** @var list<CourseData> $assignments */
        $assignments = [];

        /**
         * @var object{
         *      classroomId: string,
         *      title: string,
         *      description: string,
         *      materials: array,
         *      state: string,
         *      alternateLink: string,
         *      maxPoints: int,
         *      dueDate: string,
         *      dueTime: string,
         *      workType: string,
         *      assigneeMode: string,
         *  } $assignment
         */
        foreach ($assignmentsData as $assignment) {
            $assignments[] = new AssignmentData(
                $assignment->classroomId,
                $assignment->title,
                $assignment->description,
                $assignment->materials,
                $assignment->state,
                $assignment->alternateLink,
                $assignment->maxPoints,
                $assignment->dueDate,
                $assignment->dueTime,
                $assignment->workType,
                $assignment->assigneeMode,
            );
        }

        return $assignments;
    }
}
