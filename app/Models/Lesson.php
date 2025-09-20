<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Lessons\LessonOrder;
use App\Enums\Lessons\WeekType;
use App\Enums\Shared\DayOfWeek;
use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property DayOfWeek $day_of_week
 * @property LessonOrder $order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int $teacher_id
 * @property int $course_id
 * @property int|null $room_number
 * @property WeekType $week_type
 * @property-read Course $course
 * @property-read Teacher $teacher
 * @method static \Database\Factories\LessonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereRoomNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereWeekType($value)
 * @mixin \Eloquent
 */
final class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'day_of_week',
        'order',
        'week_type',
        'teacher_id',
        'course_id',
        'room_number',
    ];

    protected $casts = [
        'week_type' => WeekType::class,
        'order' => LessonOrder::class,
        'day_of_week' => DayOfWeek::class,
        'teacher_id' => 'integer',
        'course_id' => 'integer',
    ];

    /**
     * @return BelongsTo<Teacher, $this>
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return BelongsTo<Course, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
