<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\Resources\Banks\Interfaces\CurrencyExchangeRateResourceInterface;
use App\Services\Banks\Monobank\RetrieveMonobankCurrencyExchangeRatesService;
use App\Services\Banks\Privatbank\RetrievePrivatbankCurrencyExchangeRatesService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use kbATeam\MarkdownTable\Table;
use Telegram\Bot\Commands\Command;

final class CurrencyExchangeRateCommand extends Command
{
    protected string $name = 'currency';

    protected string $description = 'Отримати курс валют';

    public function __construct(
        private readonly RetrieveMonobankCurrencyExchangeRatesService $monobankCurrencyExchangeRatesViewModel,
        private readonly RetrievePrivatbankCurrencyExchangeRatesService $privatbankCurrencyExchangeRatesViewModel,
    ) {
    }

    public function handle(): void
    {
        $data = [
            __('bot.banks.mono', locale: 'uk') => [
                __('bot.banks.mono', locale: 'uk') => $this->monobankCurrencyExchangeRatesViewModel->get()
            ],
            __('bot.banks.privat', locale: 'uk') => [
                __('bot.banks.cash', locale: 'uk') => $this->privatbankCurrencyExchangeRatesViewModel->get(true),
                __('bot.banks.cashless', locale: 'uk') => $this->privatbankCurrencyExchangeRatesViewModel->get(false),
            ],
        ];

        $text = '';
        foreach ($data as $bank => $bankData) {
            $text .= "*Курс у $bank\\:*\n";

            foreach ($bankData as $rateType => $rateData) {
                $text .= "```$rateType\n{$this->formatTable($rateData)}```\n";
            }

            $text .= "\n";
        }

        $this->replyWithMessage([
            'text' => $text,
            'parse_mode' => 'MarkdownV2',
        ]);
    }

    /**
     * This method format data into Markdown table
     *
     * Key generation and text replacement is used to prevent non-ascii characters
     * from removing in addColumn method
     *
     * @param Collection<int, CurrencyExchangeRateResourceInterface> $rates
     */
    private function formatTable(Collection $rates): string
    {
        $currency = __('bot.banks.currency', locale: 'uk');
        $sell = __('bot.banks.sell', locale: 'uk');
        $buy = __('bot.banks.buy', locale: 'uk');

        $currencyKey = Str::random(mb_strlen($currency));
        $sellKey = Str::random(mb_strlen($sell));
        $buyKey = Str::random(mb_strlen($buy));

        $table = new Table([$currencyKey, $sellKey, $buyKey]);

        $data = $rates
            ->map(static fn (CurrencyExchangeRateResourceInterface $rate): array => [
                $currencyKey => $rate->getMainCurrency(),
                $sellKey => $rate->getRateSell(),
                $buyKey => $rate->getRateBuy(),
            ])
            ->all();

        $text = '';
        foreach ($table->generate($data) as $row) {
            $text .= $row . "\n";
        }

        return Str::of($text)
            ->replace($currencyKey, $currency)
            ->replace($sellKey, $sell)
            ->replace($buyKey, $buy)
            ->toString();
    }
}
