<?php

declare(strict_types=1);

namespace App\Enums\Assignments\GoogleClassroom;

enum AssigneeMode: string
{
    case ASSIGNEE_MODE_UNSPECIFIED = 'ASSIGNEE_MODE_UNSPECIFIED';

    case ALL_STUDENTS = 'ALL_STUDENTS';

    case INDIVIDUAL_STUDENTS = 'INDIVIDUAL_STUDENTS';
}
