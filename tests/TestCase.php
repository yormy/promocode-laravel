<?php

namespace Yormy\PromocodeLaravel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Yormy\AssertLaravel\Helpers\AssertJsonMacros;
use Yormy\PromocodeLaravel\PromocodeServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        TestConfig::setup();

        $this->withoutExceptionHandling();

        TestRoutes::setup();

        AssertJsonMacros::register();

    }

    protected function getPackageProviders($app)
    {
        return [
            PromocodeServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
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
