<?php

declare(strict_types=1);

namespace App\Enums\Assignments\GoogleClassroom;

/**
 * @see https://developers.google.com/classroom/reference/rest/v1/courses.courseWork#CourseWorkState
 */
enum CourseWorkState: string
{
    case COURSE_WORK_STATE_UNSPECIFIED = 'COURSE_WORK_STATE_UNSPECIFIED';

    case PUBLISHED = 'PUBLISHED';

    case DRAFT = 'DRAFT';

    case DELETED = 'DELETED';
}
