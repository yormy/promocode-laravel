<?php

use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripeRedeem;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Models\PromocodeInviteRedeem;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

return [
    'models' => [
        'stripe' => DiscountCodeStripe::class,
        'stripe_redeem' => DiscountCodeStripeRedeem::class,
        'invite' => PromocodeInvite::class,
        'invite_redeem' => PromocodeInviteRedeem::class,
    ],

    'stripe' => [
        'length' => 6,
        'type' => CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE,
    ],
    'invite' => [
        'length' => 9,
        'type' => CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE,
    ],

];
