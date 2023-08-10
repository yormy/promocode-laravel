<?php

namespace Yormy\PromocodeLaravel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use jdavidbakr\MailTracker\MailTrackerServiceProvider;
use LiranCo\NotificationSubscriptions\NotificationSubscriptionsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\LaravelRay\RayServiceProvider;
use Yormy\PromocodeLaravel\PromocodeServiceProvider;

abstract class TestCase extends BaseTestCase
{
   //use RefreshDatabase;

    protected function setUp(): void
    {

        parent::setUp();

        $this->setUpConfig();
    }

    protected function getPackageProviders($app)
    {
        return [
            PromocodeServiceProvider::class,
        ];
    }

    protected function setUpConfig(): void
    {
        config(['promocode' => require __DIR__.'/../../config/promocode.php']);
        config(['app.key' => 'base64:yNmpwO5YE6xwBz0enheYLBDslnbslodDqK1u+oE5CEE=']);
    }


    /**
     * @psalm-return \Closure():'next'
     */
    public function getNextClosure(): \Closure
    {
        return function () {
            return 'next';
        };
    }
}
