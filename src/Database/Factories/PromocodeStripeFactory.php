<?php

namespace Yormy\PromocodeLaravel\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mexion\BedrockUsersv2\Domain\Billing\Models\Subscription;
use Mexion\BedrockUsersv2\Domain\User\Models\Admin;
use Yormy\CoreToolsLaravel\Helpers\Password;
use Yormy\PromocodeLaravel\Models\PromocodeStripe;
use Yormy\Xid\Services\XidService;

class PromocodeStripeFactory extends Factory
{
    protected $model = PromocodeStripe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->text(10),
            'stripe_coupon_id' => 1
        ];
    }

}
