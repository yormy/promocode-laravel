<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripeRedeem;
use Yormy\PromocodeLaravel\Models\InviteCode;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Models\PromocodeInviteRedeem;
use Yormy\PromocodeLaravel\Services\PromocodeValidateInvite;
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
    public function CodeDiscount_Redeem(): void
    {
        $user = $this->createUser();

        $promocodeStripe = DiscountCodeStripe::factory()->create();

        $startCount = DiscountCodeStripeRedeem::count();
        PromocodeValidateStripe::check($promocodeStripe->code)->redeem($user);

        $this->assertGreaterThan($startCount, DiscountCodeStripeRedeem::count());
    }

    /**
     * @test
     *
     * @group redeem
     */
    public function CodeInvite_Redeem(): void
    {
        $user = $this->createUser();

        $promocodeStripe = PromocodeInvite::factory()->create();

        $startCount = PromocodeInviteRedeem::count();
        PromocodeValidateInvite::check($promocodeStripe->code)->redeem($user);

        $this->assertGreaterThan($startCount, PromocodeInviteRedeem::count());
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
        $user = $this->createUser();
        $promocodeStripe = DiscountCodeStripe::factory()->create();

        PromocodeValidateStripe::check($promocodeStripe->code)->redeem($user);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeStripe->code)->redeem();
    }
}
