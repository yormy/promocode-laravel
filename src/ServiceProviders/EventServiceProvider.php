<?php

namespace Yormy\PromocodeLaravel\ServiceProviders;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Yormy\PromocodeLaravel\Domain\Tracking\Observers\MailTrackerSubscriber;
use Yormy\PromocodeLaravel\Observers\PromocodeSubscriber;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        PromocodeSubscriber::class,
    ];
}
