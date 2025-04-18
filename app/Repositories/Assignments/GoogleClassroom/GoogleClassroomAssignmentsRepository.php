<?php

declare(strict_types=1);

namespace App\Repositories\Assignments\GoogleClassroom;

use App\DataTransferObjects\Assignments\GoogleClassroom\AssignmentData;
use App\Enums\Assignments\GoogleClassroom\AssigneeMode;
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
                'courseWorkStates' => CourseWorkState::PUBLISHED->value
            ])
            ->get("https://classroom.googleapis.com/v1/courses/{$courseId}/courseWork");

        $this->checkResponseStatus($response);

        /** @var object{courseWork: array<int, object>|null} $responseBody */
        $responseBody = json_decode($response->body(), flags: JSON_THROW_ON_ERROR);
        /** @var list<AssignmentData> $assignments */
        $assignments = [];

        /**
         * @var object{
         *      id: string,
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
        foreach ($responseBody->courseWork ?? [] as $assignment) {
            $assignments[] = new AssignmentData(
                $assignment->id,
                $assignment->title,
                $assignment->description ?? null,
                $assignment->materials ?? [],
                $assignment->state ?? CourseWorkState::DRAFT->value,
                $assignment->alternateLink,
                $assignment->maxPoints ?? null,
                $assignment->dueDate ?? null,
                $assignment->dueTime ?? null,
                $assignment->workType,
                $assignment->assigneeMode ?? AssigneeMode::ALL_STUDENTS->value,
            );
        }

        return $assignments;
    }
}
