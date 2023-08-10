<?php

namespace Yormy\PromocodeLaravel\Tests\Unit\Domain\Create\Parsing;

use Yormy\PromocodeLaravel\Exceptions\InvalidValueException;
use Yormy\PromocodeLaravel\Facades\PromocodeStripeFacade;
use Yormy\PromocodeLaravel\Models\PromocodeStripe;
use Yormy\PromocodeLaravel\Tests\TestCase;
use Yormy\PromocodeLaravel\Tests\Traits\UserTrait;

class CreateCodesTest extends TestCase
{
    use UserTrait;

    protected function setUp(): void
    {
        parent::setUp();
        PromocodeStripe::truncate();
    }

    /**
     * @test
     *
     * @group xxx
     */
    public function CreateRandomCode(): void
    {
        $promocodeStripe  = PromocodeStripeFacade::stripeCouponId('stripe-coupon-id')->create();
        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }

    /**
     * @test
     *
     * @group xxx
     */
    public function CreateSpecifiedCode(): void
    {
        $codeValue = 'my-code-value';
        $promocodeStripe  = PromocodeStripeFacade::stripeCouponId('stripe-coupon-id')->create($codeValue);
        $this->assertTrue($promocodeStripe->code === $codeValue);
    }

    /**
     * @test
     *
     * @group xxx
     */
    public function Create_WithDiscountAmountAndPercentage_Exception(): void
    {
        $this->expectException(InvalidValueException::class);
        PromocodeStripeFacade::stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountPercentage(10)
            ->descriptionDiscountAmountCents(10)
            ->create();
    }


    /**
     * @test
     *
     * @group xxx
     */
    public function Create_WitDiscountPercentage(): void
    {
        $promocodeStripe  = PromocodeStripeFacade::stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountPercentage(10)
            ->create();
        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }

    /**
     * @test
     *
     * @group xxx
     */
    public function Create_WitDiscountAmount(): void
    {
        $promocodeStripe  = PromocodeStripeFacade::stripeCouponId('stripe-coupon-id')
            ->internalName('Some Internal Name')
            ->description('Description for the user')
            ->descriptionDiscountAmountCents(10)
            ->create();
        $this->assertTrue(strlen($promocodeStripe->code) === 7);
    }

}
