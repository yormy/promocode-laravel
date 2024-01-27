<?php

namespace Yormy\PromocodeLaravel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Yormy\PromocodeLaravel\PromocodeServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpConfig();

        $this->setupRoutes();
    }

    protected function getPackageProviders($app)
    {
        return [
            PromocodeServiceProvider::class,
        ];
    }

    protected function setUpConfig(): void
    {
        config(['promocode' => require __DIR__.'/../config/promocode.php']);
        config(['app.key' => 'base64:yNmpwO5YE6xwBz0enheYLBDslnbslodDqK1u+oE5CEE=']);
    }


    protected function setupRoutes()
    {
        Route::prefix('admin2/')
            ->name('api.v1.admin.')
            ->middleware('api')
            ->group(function () {
                Route::PromocodesApiV1();
            });
    }

    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {

            $this->artisan('db:wipe');

            $this->loadMigrationsFrom(__DIR__.'/../tests/Setup/Database/Migrations');
            $this->artisan('migrate');

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }
}
