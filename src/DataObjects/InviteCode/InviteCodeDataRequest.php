<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\InviteCode;

use Yormy\PromocodeLaravel\DataObjects\Promocode\PromocodeDataRequest;

class InviteCodeDataRequest extends PromocodeDataRequest
{
    use UseInviteCodeExtention;
}
