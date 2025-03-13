<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DayOfWeek;
use App\Enums\LessonOrder;
use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property DayOfWeek $day_of_week
 * @property LessonOrder $order
 * @property bool|null $is_numerator
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int|null $teacher_id
 * @property-read Teacher|null $teacher
 * @method static \Database\Factories\LessonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereIsNumerator($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'day_of_week',
        'order',
        'is_numerator',
        'teacher_id',
    ];

    protected $casts = [
        'is_numerator' => 'boolean',
        'order' => LessonOrder::class,
        'day_of_week' => DayOfWeek::class,
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
