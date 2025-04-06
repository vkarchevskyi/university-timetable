<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Assignments\GoogleClassroom;

final readonly class AssignmentData
{
    public function __construct(
        public string $classroomId,
        public string $title,
        public string $description,
        public array $materials,
        public string $state,
        public string $alternateLink,
        public int $maxPoints,
        public string $dueDate,
        public string $dueTime,
        public string $workType,
        public string $assigneeMode,
    ) {
    }
}
