<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Lessons\LessonOrder;
use Database\Factories\ExceptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property \Carbon\CarbonImmutable $date
 * @property LessonOrder $order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int|null $teacher_id
 * @property int|null $course_id
 * @property int|null $room_number
 * @property-read Course|null $course
 * @property-read Teacher|null $teacher
 * @method static \Database\Factories\ExceptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereRoomNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Exception extends Model
{
    /** @use HasFactory<ExceptionFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'order',
        'teacher_id',
        'course_id',
    ];

    protected $casts = [
        'date' => 'immutable_datetime',
        'order' => LessonOrder::class,
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
