<?php

use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

return [
    'models' => [
        'stripe' => DiscountCodeStripe::class,
        'invite' => PromocodeInvite::class,
    ],

    'stripe' => [
        'length' => 6,
        'type' => CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE,
    ],
    'invite' => [
        'length' => 9,
        'type' => CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE,
    ]

];
