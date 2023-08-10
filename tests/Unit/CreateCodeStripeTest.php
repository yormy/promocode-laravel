<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Illuminate\Support\Str;
use Yormy\PromocodeLaravel\DataObjects\PromocodeStripeDto;
use Yormy\PromocodeLaravel\Exceptions\InvalidValueException;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
use Yormy\PromocodeLaravel\Tests\TestCase;
use Yormy\PromocodeLaravel\Tests\Traits\UserTrait;

class CreateCodeStripeTest extends TestCase
{
    use UserTrait;

    /**
     * @test
     *
     * @group create-code
     */
    public function CreateRandomCode(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function CreateSpecifiedCode(): void
    {
        $codeValue = Str::random(10);
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray($codeValue);
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->assertTrue($promocodeStripe->code === $codeValue);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function Create_WithDiscountAmountAndPercentage_Exception(): void
    {
        $this->expectException(InvalidValueException::class);
        PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountPercentage(10)
            ->descriptionDiscountAmountCents(10)
            ->toArray();
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function Create_WitDiscountPercentage(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountPercentage(10)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function Create_WitDiscountAmount(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountAmountCents(10)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }
}
