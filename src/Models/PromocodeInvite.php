<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Models;

use Yormy\PromocodeLaravel\Repositories\PromocodeInviteRedeemRepository;

class PromocodeInvite extends InviteCode
{
    protected $table = 'promocodes_invites';

    public function redeem($user): void
    {
        $this->increment('uses_current');

        $promocodeInviteRedeemRepository = new PromocodeInviteRedeemRepository();
        $promocodeInviteRedeemRepository->create($this, $user);
    }
}
