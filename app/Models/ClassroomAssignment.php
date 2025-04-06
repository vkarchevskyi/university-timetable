<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Assignments\GoogleClassroom\AssigneeMode;
use App\Enums\Assignments\GoogleClassroom\CourseWorkState;
use App\Enums\Assignments\GoogleClassroom\CourseWorkType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $classroom_course_id
 * @property string $title
 * @property bool $stop_date_sync
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $classroom_id
 * @property string|null $description
 * @property array<array-key, mixed> $materials
 * @property CourseWorkState $state
 * @property string $alternate_link
 * @property int|null $max_points
 * @property \Carbon\CarbonImmutable|null $due_datetime
 * @property CourseWorkType $work_type
 * @property AssigneeMode $assignee_mode
 * @method static Builder<static>|ClassroomAssignment newModelQuery()
 * @method static Builder<static>|ClassroomAssignment newQuery()
 * @method static Builder<static>|ClassroomAssignment published()
 * @method static Builder<static>|ClassroomAssignment query()
 * @method static Builder<static>|ClassroomAssignment whereAlternateLink($value)
 * @method static Builder<static>|ClassroomAssignment whereAssigneeMode($value)
 * @method static Builder<static>|ClassroomAssignment whereClassroomCourseId($value)
 * @method static Builder<static>|ClassroomAssignment whereClassroomId($value)
 * @method static Builder<static>|ClassroomAssignment whereCreatedAt($value)
 * @method static Builder<static>|ClassroomAssignment whereDescription($value)
 * @method static Builder<static>|ClassroomAssignment whereDueDatetime($value)
 * @method static Builder<static>|ClassroomAssignment whereId($value)
 * @method static Builder<static>|ClassroomAssignment whereMaterials($value)
 * @method static Builder<static>|ClassroomAssignment whereMaxPoints($value)
 * @method static Builder<static>|ClassroomAssignment whereState($value)
 * @method static Builder<static>|ClassroomAssignment whereStopDateSync($value)
 * @method static Builder<static>|ClassroomAssignment whereTitle($value)
 * @method static Builder<static>|ClassroomAssignment whereUpdatedAt($value)
 * @method static Builder<static>|ClassroomAssignment whereWorkType($value)
 * @mixin \Eloquent
 */
final class ClassroomAssignment extends Model
{
    protected $fillable = [
        'classroom_course_id',
        'title',
        'stop_date_sync',
        'classroom_id',
        'description',
        'materials',
        'state',
        'alternate_link',
        'max_points',
        'due_datetime',
        'work_type',
        'assignee_mode',
    ];

    protected $casts = [
        'classroom_course_id' => 'integer',
        'title' => 'string',
        'stop_date_sync' => 'boolean',
        'classroom_id' => 'string',
        'description' => 'string',
        'materials' => 'array',
        'state' => CourseWorkState::class,
        'alternate_link' => 'string',
        'max_points' => 'integer',
        'due_datetime' => 'immutable_datetime',
        'work_type' => CourseWorkType::class,
        'assignee_mode' => AssigneeMode::class,
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('state', CourseWorkState::PUBLISHED);
    }
}
