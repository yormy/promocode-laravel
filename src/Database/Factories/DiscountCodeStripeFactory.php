<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;

class DiscountCodeStripeFactory extends PromocodeFactory
{
    protected $model = DiscountCodeStripe::class;

    public function definition()
    {
        $data = parent::definition();
        $data['stripe_coupon_id'] = 'stripe_coupon_id';

        return $data;
    }

    public function discountAmount(int $discountInCents): Factory
    {
        return $this->state(function () use ($discountInCents) {
            return [
                'description_discount_amount_cents' => $discountInCents,
            ];
        });
    }

    public function discountPercentage(int $discountPercentage): Factory
    {
        return $this->state(function () use ($discountPercentage) {
            return [
                'description_discount_percentage' => $discountPercentage,
            ];
        });
    }
}
