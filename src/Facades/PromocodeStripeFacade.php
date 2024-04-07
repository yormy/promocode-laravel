<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Facades;

use Illuminate\Support\Facades\Facade;
use Yormy\PromocodeLaravel\Services\PromocodeStripeService;

class PromocodeStripeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PromocodeStripeService::class;
    }
}
