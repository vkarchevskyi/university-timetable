<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Assignments\GoogleClassroom;

final class CourseData
{
    public function __construct(
        public string $classroomId,
        public string $name,
        public string $ownerId,
        public string $courseState,
        public string $alternateLink,
        public string $calendarId,
    ) {
    }
}
