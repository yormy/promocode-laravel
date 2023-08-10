<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Yormy\PromocodeLaravel\DataObjects\PromocodeStripeDto;
use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
use Yormy\PromocodeLaravel\Services\PromocodeValidateStripe;
use Yormy\PromocodeLaravel\Tests\TestCase;
use Yormy\PromocodeLaravel\Tests\Traits\UserTrait;

class RedeemTest extends TestCase
{
    use UserTrait;

    /**
     * @test
     *
     * @group redeem
     */
    public function Code_Redeem(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocode = BillingPromocodeStripe::create($data);

        PromocodeValidateStripe::check($promocode->code)->redeem();

        $this->assertTrue(true);
    }

    /**
     * @test
     *
     * @group redeem
     */
    public function Code_RedeemWrong_Exception(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check('xxx')->redeem();
    }

    /**
     * @test
     *
     * @group redeem
     */
    public function Code_RedeemTwice_Exception(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocode = BillingPromocodeStripe::create($data);

        PromocodeValidateStripe::check($promocode->code)->redeem();

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocode->code)->redeem();
    }
}
