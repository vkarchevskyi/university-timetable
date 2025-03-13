<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\LessonOrder;
use Database\Factories\ExceptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property \Carbon\CarbonImmutable $date
 * @property LessonOrder $order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereUpdatedAt($value)
 * @method static \Database\Factories\ExceptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exception whereOrder($value)
 * @mixin \Eloquent
 */
final class Exception extends Model
{
    /** @use HasFactory<ExceptionFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'order'
    ];

    protected $casts = [
        'date' => 'immutable_datetime',
        'order' => LessonOrder::class,
    ];
}
