<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $telegram_user_id
 * @property int $telegram_chat_id
 * @property string $text
 * @property bool $is_ai
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereIsAi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereTelegramChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereTelegramUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class TelegramMessage extends Model
{
    protected $fillable = [
        'telegram_user_id',
        'telegram_chat_id',
        'text',
        'is_ai',
    ];

    protected $casts = [
        'telegram_user_id' => 'integer',
        'telegram_chat_id' => 'integer',
        'text' => 'string',
        'is_ai' => 'boolean',
    ];
}
