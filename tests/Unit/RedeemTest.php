<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
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
        $promocodeStripe = DiscountCodeStripe::factory()->create();

        PromocodeValidateStripe::check($promocodeStripe->code)->redeem();

        $this->assertTrue(true);
    }

    /**
     * @test
     *
     * @group redeem
     */
    public function Code_RedeemWrong_Exception(): void
    {
        DiscountCodeStripe::factory()->create();

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
        $promocodeStripe = DiscountCodeStripe::factory()->create();

        PromocodeValidateStripe::check($promocodeStripe->code)->redeem();

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeStripe->code)->redeem();
    }
}
