<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Assignments\GoogleClassroom\CourseState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $teacher_id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $owner_id
 * @property string $classroom_id
 * @property CourseState $course_state
 * @property string $alternate_link
 * @property string|null $calendar_id
 * @method static Builder<static>|ClassroomCourse active()
 * @method static Builder<static>|ClassroomCourse newModelQuery()
 * @method static Builder<static>|ClassroomCourse newQuery()
 * @method static Builder<static>|ClassroomCourse query()
 * @method static Builder<static>|ClassroomCourse whereAlternateLink($value)
 * @method static Builder<static>|ClassroomCourse whereCalendarId($value)
 * @method static Builder<static>|ClassroomCourse whereClassroomId($value)
 * @method static Builder<static>|ClassroomCourse whereCourseId($value)
 * @method static Builder<static>|ClassroomCourse whereCourseState($value)
 * @method static Builder<static>|ClassroomCourse whereCreatedAt($value)
 * @method static Builder<static>|ClassroomCourse whereId($value)
 * @method static Builder<static>|ClassroomCourse whereName($value)
 * @method static Builder<static>|ClassroomCourse whereOwnerId($value)
 * @method static Builder<static>|ClassroomCourse whereTeacherId($value)
 * @method static Builder<static>|ClassroomCourse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class ClassroomCourse extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'name',
        'owner_id',
        'classroom_id',
        'course_state',
        'alternate_link',
        'calendar_id',
    ];

    protected $casts = [
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'name' => 'string',
        'owner_id' => 'string',
        'classroom_id' => 'string',
        'course_state' => CourseState::class,
        'alternate_link' => 'string',
        'calendar_id' => 'string',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('course_state', CourseState::ACTIVE);
    }
}
