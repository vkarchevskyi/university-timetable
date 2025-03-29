<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use GeminiAPI\Client;
use GeminiAPI\GenerationConfig;
use GeminiAPI\GenerativeModel;
use Illuminate\Container\Attributes\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            GenerativeModel::class,
            static fn (
                #[Config('services.google.gemini.api_key')] string $geminiApiKey,
                #[Config('services.google.gemini.model')] string $model,
                #[Config('services.google.gemini.top_k')] int $topK,
                #[Config('services.google.gemini.top_p')] float $topP,
                #[Config('services.google.gemini.temperature')] int|float $temperature,
                #[Config('services.google.gemini.max_output_tokens')] int $maxOutputTokens,
            ): GenerativeModel => (new Client($geminiApiKey))
                ->generativeModel($model)
                ->withGenerationConfig(
                    (new GenerationConfig())
                        ->withTopK($topK)
                        ->withTopP($topP)
                        ->withTemperature($temperature)
                        ->withMaxOutputTokens($maxOutputTokens)
                )
        );

        $this->app->singleton(GoogleProvider::class, static function (): GoogleProvider {
            /** @var GoogleProvider $googleProvider */
            $googleProvider = Socialite::driver('google');

            return $googleProvider;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configureUrls();
        $this->configureVite();
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    /**
     * Configure the application's dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configure the application's models.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();
    }

    /**
     * Configure the application's URLs.
     */
    private function configureUrls(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Configure the application's Vite instance.
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }
}
