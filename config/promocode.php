<?php

use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;

return [
    'models' => [
        'stripe' => BillingPromocodeStripe::class,
        'invite' => PromocodeInvite::class,
    ],
];
