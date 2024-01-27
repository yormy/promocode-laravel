<?php

namespace Yormy\PromocodeLaravel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Yormy\PromocodeLaravel\PromocodeServiceProvider;
use Yormy\AssertLaravel\Helpers\AssertJsonMacros;

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
