<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Services;

use Yormy\PromocodeLaravel\Models\PromocodeInvite;

class PromocodeValidateInvite extends PromocodeValidate
{
    public static function getModel()
    {
        return new PromocodeInvite();
    }
}
