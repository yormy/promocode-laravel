<?php

namespace Yormy\PromocodeLaravel;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use jdavidbakr\MailTracker\MailTracker;
use Yormy\PromocodeLaravel\ServiceProviders\EventServiceProvider;
use Yormy\PromocodeLaravel\ServiceProviders\RouteServiceProvider;

class PromocodeServiceProvider extends ServiceProvider
{
    const CONFIG_FILE = __DIR__.'/../config/promocode.php';

    const CONFIG_IDE_HELPER_FILE = __DIR__.'/../config/ide-helper.php';

    /**
     * @psalm-suppress MissingReturnType
     */
    public function boot(Router $router)
    {
        $this->publish();

        $this->registerCommands();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerListeners();

        $this->registerTranslations();

        $this->morphMaps();
    }

    /**
     * @psalm-suppress MixedArgument
     */
    public function register()
    {
        $this->mergeConfigFrom(static::CONFIG_FILE, 'promocode');
        $this->mergeConfigFrom(static::CONFIG_IDE_HELPER_FILE, 'ide-helper');

        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    private function publish(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                self::CONFIG_FILE => config_path('promocode.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/chaski'),
            ], 'translations');
        }
    }

    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }
    }

    public function registerListeners(): void
    {
        //        $this->app['events']->listen(XxxEvent::class, XxxListener::class);
    }

    public function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'promocode');
    }

    private function morphMaps(): void
    {
        //        $logModelpath = config('chaski.models.log');
        //        $sections = explode('\\', $logModelpath);
        //        $LogModelName = end($sections);
        //
        //        $blockModelpath = config('chaski.models.block');
        //        $sections = explode('\\', $blockModelpath);
        //        $blockModelName = end($sections);
        //
        //        Relation::enforceMorphMap([
        //            $LogModelName => $logModelpath,
        //            $blockModelName => $blockModelpath,
        //        ]);
    }
}
