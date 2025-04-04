<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\Resource\Monobank\CurrencyExchangeRateResource;
use App\Services\Lessons\Telegram\EscapeCharactersService;
use App\Services\Monobank\GetCurrencyExchangeRatesService;
use Illuminate\Support\Collection;
use Telegram\Bot\Commands\Command;

final class CurrencyExchangeRateCommand extends Command
{
    protected string $name = 'currency';

    protected string $description = 'Отримати розклад валют';

    public function __construct(
        private readonly EscapeCharactersService $escapeCharactersService,
        private readonly GetCurrencyExchangeRatesService $getCurrencyExchangeRatesService,
    ) {
    }

    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle(
                "**Курс валют** (Monobank): \n\n" .
                $this->getCurrencyExchangeRatesService->handle(new Collection())
                    ->implode(static fn (CurrencyExchangeRateResource $rate): string => sprintf(
                        "**%s** - **%s**\nКупівля: %s\nПродаж: %s\n",
                        $rate->currencyA,
                        $rate->currencyB,
                        $rate->rateBuy,
                        $rate->rateSell,
                    ), "\n"),
            ),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
