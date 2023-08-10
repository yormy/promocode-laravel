<?php

namespace Yormy\PromocodeLaravel\Models;

use Yormy\CoreToolsLaravel\Traits\Factories\PackageFactoryTrait;

class PromocodeStripe extends Promocode
{
    use PackageFactoryTrait;

    protected $table = 'billing_promocode_stripe';

    protected $fillable = [
        'internal_name',
        'code',
        'stripe_coupon_id',

        'description',
        'description_discount_percentage',
        'description_discount_amount_cents',
    ];
}
