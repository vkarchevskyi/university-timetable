<?php

declare(strict_types=1);

namespace App\Repositories\Assignments\GoogleClassroom;

use App\DataTransferObjects\Assignments\GoogleClassroom\CourseData;
use App\Exceptions\Assignments\GoogleClassroom\AuthenticationException;
use App\Models\User;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use JsonException;
use RuntimeException;

final readonly class GoogleClassroomCoursesRepository
{
    public function __construct(
        private Factory $http,
        #[Config('services.google.classroom.endpoints.courses.list')]
        private string $courseListUrl
    ) {
    }

    /**
     * @return list<CourseData>
     * @throws ConnectionException
     * @throws JsonException
     * @throws AuthenticationException
     * @throws RuntimeException
     */
    public function list(): array
    {
        $user = User::googleServiceAccount()->firstOrFail();

        $response = $this->http
            ->withToken($user->google_token)
            ->get($this->courseListUrl);

        if ($response->status() === 401) {
            /** @var object{code: int, message: string, status: string} $errorData */
            $errorData = json_decode($response->body(), flags: JSON_THROW_ON_ERROR)->error;

            throw new AuthenticationException($errorData->message, $errorData->code);
        }

        if (!$response->successful()) {
            throw new RuntimeException("Unsuccessful request. Status 200 expected, {$response->status()} received");
        }

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
