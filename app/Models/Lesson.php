<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\LessonOrder;
use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $day_of_week
 * @property LessonOrder $order
 * @property bool|null $is_numerator
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereUpdatedAt($value)
 *
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
    ];

    protected $casts = [
        'is_numerator' => 'boolean',
        'order' => LessonOrder::class,
    ];
}
