<?php

namespace Yormy\PromocodeLaravel\ServiceProviders;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Yormy\PromocodeLaravel\Routes\Api\V1\Admin\AdminApiRoutes;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->map();

    }

    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes(): void
    {
    }

    protected function mapApiRoutes(): void
    {
       AdminApiRoutes::register();
    }
}
