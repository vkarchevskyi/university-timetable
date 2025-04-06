<?php

declare(strict_types=1);

namespace App\Enums\Assignments\GoogleClassroom;

enum CourseWorkType: string
{
    case COURSE_WORK_TYPE_UNSPECIFIED = 'COURSE_WORK_TYPE_UNSPECIFIED';

    case ASSIGNMENT = 'ASSIGNMENT';

    case SHORT_ANSWER_QUESTION = 'SHORT_ANSWER_QUESTION';

    case MULTIPLE_CHOICE_QUESTION = 'MULTIPLE_CHOICE_QUESTION';
}
