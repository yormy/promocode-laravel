<?php

namespace Yormy\PromocodeLaravel\Observers;

use Illuminate\Events\Dispatcher;
use Yormy\PromocodeLaravel\Observers\Interfaces\LoggableEventInterface;
use Yormy\PromocodeLaravel\Observers\Listeners\LogEvent;

class PromocodeSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
    }
}
