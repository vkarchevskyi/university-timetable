<?php

declare(strict_types=1);

namespace App\Enums\Assignments\GoogleClassroom;

/**
 * see https://developers.google.com/classroom/reference/rest/v1/courses#CourseState
 */
enum CourseState: string
{
    case COURSE_STATE_UNSPECIFIED = 'COURSE_STATE_UNSPECIFIED';

    case ACTIVE = 'ACTIVE';

    case ARCHIVED = 'ARCHIVED';

    case PROVISIONED = 'PROVISIONED';

    case DECLINED = 'DECLINED';

    case SUSPENDED = 'SUSPENDED';
}
