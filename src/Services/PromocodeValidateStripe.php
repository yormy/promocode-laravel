<?php

namespace Yormy\PromocodeLaravel\Services;

use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;

class PromocodeValidateStripe extends PromocodeValidate
{
    public static function getModel()
    {
        return new BillingPromocodeStripe();
    }
}
