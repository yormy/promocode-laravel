<?php

namespace Yormy\PromocodeLaravel\DataObjects;

use Yormy\PromocodeLaravel\Exceptions\InvalidValueException;

class PromocodeStripeDto extends PromocodeDto
{
    protected int $descriptionDiscountPercentage;

    protected int $descriptionDiscountAmountCents;

    protected string $stripeCouponId;

    public static function make(): self
    {
        return new static;
    }

    public function stripeCouponId(string $stripeCouponId): self
    {
        $this->stripeCouponId = $stripeCouponId;

        return $this;
    }

    public function descriptionDiscountPercentage(int $descriptionDiscountPercentage): self
    {
        $this->descriptionDiscountPercentage = $descriptionDiscountPercentage;

        return $this;
    }

    public function descriptionDiscountAmountCents(int $descriptionDiscountAmountCents): self
    {
        $this->descriptionDiscountAmountCents = $descriptionDiscountAmountCents;

        return $this;
    }

    public function toArray(string $code = null): array
    {
        $data = parent::toArray($code);

        $data['stripe_coupon_id'] = $this->stripeCouponId;

        if (isset($this->descriptionDiscountAmountCents) && isset($this->descriptionDiscountPercentage)) {
            throw new InvalidValueException('Cannot set discount in Percentage AND in Amount');
        }

        if (isset($this->descriptionDiscountPercentage)) {
            $data['description_discount_percentage'] = $this->descriptionDiscountPercentage;
        }

        if (isset($this->descriptionDiscountAmountCents)) {
            $data['description_discount_amount_cents'] = $this->descriptionDiscountAmountCents;
        }

        return $data;
    }
}
