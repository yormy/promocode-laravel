<?php

namespace Yormy\PromocodeLaravel\Services;

use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;

class PromocodeValidateStripe extends PromocodeValidate
{
    public static function getModel()
    {
        return new DiscountCodeStripe();
    }
}
