<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeDataRequest;
use Yormy\PromocodeLaravel\Models\InviteCode;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Models\PromocodeInviteRedeem;

class PromocodeInviteRedeemRepository
{
    public function __construct(private ?PromocodeInviteRedeem $model = null)
    {
        if (! $model) {
            $this->model = new PromocodeInviteRedeem();
        }
    }

    public function create(InviteCode $invite, $user): void
    {
        $this->model->create([
            'user_id' => $user->id,
            'user_type' => get_class($user),
            'promocode_invite_id' => $invite->id
        ]);
    }
}

