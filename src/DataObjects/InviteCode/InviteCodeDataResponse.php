<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\InviteCode;

use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataResponse;

class InviteCodeDataResponse extends PromocodeDataResponse
{
    use InviteCodeTrait;
}
