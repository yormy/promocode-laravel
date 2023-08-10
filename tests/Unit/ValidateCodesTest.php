<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\DataObjects\PromocodeStripeDto;
use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
use Yormy\PromocodeLaravel\Services\PromocodeValidateStripe;
use Yormy\PromocodeLaravel\Tests\TestCase;
use Yormy\PromocodeLaravel\Tests\Traits\UserTrait;

class ValidateCodesTest extends TestCase
{
    use UserTrait;

    /**
     * @test
     *
     * @group validate-code
     */
    public function Code_Found(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $promocode = PromocodeValidateStripe::check($promocodeStripe->code);
        $this->assertNotNull($promocode);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function Code_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check('hhhhh');
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function Code_NotActive_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->activeFrom(CarbonImmutable::now()->addDay())
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeStripe->code);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function Code_Expired_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->expiresInDays(-1)
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeStripe->code);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function Code_NoUsageLeft_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->expiresInDays(-1)
            ->stripeCouponId('stripe-coupon-id')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $promocodeStripe->current_uses = 1;
        $promocodeStripe->save();

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeStripe->code);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForUser_CorrectUser_Found(): void
    {
        $userCode = $this->createUser();
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forUser($userCode)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $promocode = PromocodeValidateStripe::checkForUser($promocodeStripe->code, $userCode);
        $this->assertNotNull($promocode);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForUser_OtherUser_NotFound(): void
    {
        $userCode = $this->createUser();

        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forUser($userCode)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $userCurrent = $this->createUser();

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::checkForUser($promocodeStripe->code, $userCurrent);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForEmail_CorrectEmail_Found(): void
    {
        $email = 'test@example.com';
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forEmail($email)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $promocode = PromocodeValidateStripe::checkForEmail($promocodeStripe->code, $email);
        $this->assertNotNull($promocode);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForEmail_WrongEmail_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forEmail('test@example.com')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::checkForEmail($promocodeStripe->code, 'other@example.com');
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForIp_CorrectIp_Found(): void
    {
        $ip = '127.0.0.1';
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forIp($ip)
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $promocode = PromocodeValidateStripe::checkForIp($promocodeStripe->code, $ip);
        $this->assertNotNull($promocode);
    }

    /**
     * @test
     *
     * @group validate-code
     */
    public function CodeForIp_WrongIp_NotFound(): void
    {
        $data = PromocodeStripeDto::make()
            ->stripeCouponId('stripe-coupon-id')
            ->forIp('127.0.0.1')
            ->toArray();
        $promocodeStripe = BillingPromocodeStripe::create($data);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::checkForIp($promocodeStripe->code, '192.168.1.1');
    }
}
