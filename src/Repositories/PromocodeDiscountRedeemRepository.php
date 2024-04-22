<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Repositories;

use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeDataRequest;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripeRedeem;
use Yormy\PromocodeLaravel\Models\InviteCode;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Models\PromocodeInviteRedeem;

class PromocodeDiscountRedeemRepository
{
    public function __construct(private ?DiscountCodeStripeRedeem $model = null)
    {
        if (! $model) {
            $this->model = new DiscountCodeStripeRedeem();
        }
    }

    public function create(DiscountCodeStripe $invite, $user): void
    {
        $this->model->create([
            'user_id' => $user->id,
            'user_type' => get_class($user),
            'billing_promocode_stripe_id' => $invite->id
        ]);
    }
}

