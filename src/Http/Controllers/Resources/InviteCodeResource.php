<?php

namespace Yormy\PromocodeLaravel\Http\Controllers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InviteCodeResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'xid' => $this->xid,
            'internalName' => $this->internal_name,
            'description' => $this->description,
//            'descriptionDiscountPercentage' => $this->description_discount_percentage,
//            'descriptionDiscountAmountCents' => $this->description_discount_amount_cents,
//            'stripeCouponId' => $this->stripe_coupon_id,
            'code' => $this->code,
            'usesMax' => $this->uses_max,
            'usesCurrent' => $this->uses_current,
            'usesLeft' => $this->uses_left,
            'forUserId' => $this->for_user_id,
            'forIp' => $this->for_ip,
            'forEmail' => $this->for_email,

            'activeFrom' => $this->active_from,
            'expiresAt' => $this->expires_at,
            'isActive' => (bool)$this->isActive,
            'isAvailable' => (bool)$this->isAvailable,
        ];

        return $data;
    }
}
