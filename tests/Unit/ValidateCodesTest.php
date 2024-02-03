<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Carbon\CarbonImmutable;
use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
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
        $promocodeStripe = DiscountCodeStripe::factory()->create();

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
        DiscountCodeStripe::factory()->create();

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
        $promocodeStripe = DiscountCodeStripe::factory()->activeFrom(CarbonImmutable::now()->addDay())->create();

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
        $promocodeStripe = DiscountCodeStripe::factory()->expired()->create();

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
        $promocodeStripe = DiscountCodeStripe::factory()->expired()->create();

        $promocodeStripe->uses_current = 1;
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
        $this->markTestSkipped('Somehow not working in sqllite');

        $userCode = $this->createUser();
        $promocodeStripe = DiscountCodeStripe::factory()->forUser($userCode)->create();

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
        $this->markTestSkipped('Somehow not working in sqllite');

        $userCode = $this->createUser();
        $promocodeStripe = DiscountCodeStripe::factory()->forUser($userCode)->create();

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

        $promocodeStripe = DiscountCodeStripe::factory()->forEmail($email)->create();
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
        $promocodeStripe = DiscountCodeStripe::factory()->forEmail('test@example.com')->create();

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
        $promocodeStripe = DiscountCodeStripe::factory()->forIp($ip)->create();

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
        $ip = '127.0.0.1';
        $promocodeStripe = DiscountCodeStripe::factory()->forIp($ip)->create();

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::checkForIp($promocodeStripe->code, '192.168.1.1');
    }
}
