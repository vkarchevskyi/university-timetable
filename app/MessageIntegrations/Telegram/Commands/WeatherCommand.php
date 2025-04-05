<?php

declare(strict_types=1);

namespace App\MessageIntegrations\Telegram\Commands;

use App\Services\Lessons\Telegram\EscapeCharactersService;
use Carbon\CarbonImmutable;
use DateInvalidTimeZoneException;
use Exception;
use Illuminate\Container\Attributes\Config;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Message;
use Vkarchevskyi\SinoptikUaParser\Factories\ScraperFactory;

final class WeatherCommand extends Command
{
    protected string $name = 'weather';

    protected array $aliases = [
        'currentweather'
    ];

    protected string $description = 'Отримати дані про погоду';

    public function __construct(
        private readonly EscapeCharactersService $escapeCharactersService,
        private readonly ScraperFactory $scraperFactory,
        #[Config('services.sinoptik.default_city')] private readonly string $defaultCity,
        #[Config('services.sinoptik.hide')] private readonly array $hide,
    ) {
    }

    /**
     * @throws DateInvalidTimeZoneException
     * @throws Exception
     */
    public function handle(): void
    {
        /** @var Message $message */
        $message = $this->getUpdate()->getMessage();
        $messageParts = explode(' ', $message->text, 2);
        $command = $messageParts[0];
        $query = $messageParts[1] ?? null;

        $date = CarbonImmutable::now();
        if (is_string($query) && preg_match('/\b(\d{1,2})\.(\d{1,2})\s*/u', $query, $matches)) {
            $date = CarbonImmutable::createFromDate(month: (int)$matches[2], day: (int)$matches[1]);
        }

        $scraper = $this->scraperFactory
            ->setCity($this->defaultCity)
            ->setDate($date)
            ->make();

        $text = '*Погода на ' . $date->format('d.m') . "*\n\n";

        $scraperData = mb_strtolower($command) === '/currentweather'
            ? [$scraper->getCurrentTimeData()]
            : $scraper->getData();

        foreach ($scraperData as $periodData) {
            $text .= "*$periodData->time*";

            foreach ($periodData->data as $key => $value) {
                if ($key === 'description') {
                    $text .= " — *" . str_replace("\n", ' ', $value) . '* ' . $periodData->data->getEmoji() . "\n";
                    continue;
                }

                if ($command === "/$this->name" && in_array($key, $this->hide, true)) {
                    continue;
                }

                $text .= __("bot.weather.$key", locale: 'uk') . " $value\n";
            }

            $text .= "\n";
        }

        $this->replyWithMessage([
            'text' => $this->escapeCharactersService->handle($text),
            'parse_mode' => 'MarkdownV2',
        ]);
    }
}
