<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Services;

use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;

class PromocodeValidateStripe extends PromocodeValidate
{
    public static function getModel()
    {
        return new DiscountCodeStripe();
    }
}
