<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Telegram\Bot\Api;

final class TelegramController extends Controller
{
    public function webhook(Api $telegram): Response
    {
        $telegram->commandsHandler(true);

        return new Response('ok');
    }
}
