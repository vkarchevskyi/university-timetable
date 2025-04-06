<?php

declare(strict_types=1);

namespace App\Repositories\Assignments\GoogleClassroom;

use App\DataTransferObjects\Assignments\GoogleClassroom\CourseData;
use App\Exceptions\Assignments\GoogleClassroom\ApiAuthenticationException;
use App\Exceptions\Assignments\GoogleClassroom\ApiException;
use Illuminate\Http\Client\ConnectionException;
use JsonException;

final readonly class GoogleClassroomCoursesRepository extends AbstractGoogleClassroomRepository
{
    /**
     * @return list<CourseData>
     * @throws ConnectionException
     * @throws JsonException
     * @throws ApiAuthenticationException
     * @throws ApiException
     */
    public function list(): array
    {
        $user = $this->getUser();

        $response = $this->http
            ->withToken($user->google_token)
            ->get('https://classroom.googleapis.com/v1/courses');

        $this->checkResponseStatus($response);

        /** @var array<int, object> $coursesData */
        $coursesData = json_decode($response->body(), flags: JSON_THROW_ON_ERROR)->courses;
        /** @var list<CourseData> $courses */
        $courses = [];

        /**
         * @var object{
         *      id: string,
         *      name: string,
         *      ownerId: string,
         *      courseState: string,
         *      alternateLink: string,
         *      calendarId: string
         *  } $course
         */
        foreach ($coursesData as $course) {
            $courses[] = new CourseData(
                $course->id,
                $course->name,
                $course->ownerId,
                $course->courseState,
                $course->alternateLink,
                $course->calendarId,
            );
        }

        return $courses;
    }
}
