<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Yormy\PromocodeLaravel\Exceptions\InvalidCodeException;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\PromocodeValidateInvite;
use Yormy\PromocodeLaravel\Services\PromocodeValidateStripe;
use Yormy\PromocodeLaravel\Tests\TestCase;

class CreateCodeTest extends TestCase
{
    /**
     * @test
     *
     * @group create-invite
     */
    public function CreateRandomCode_Invite(): void
    {
        $promocodeInvite = PromocodeInvite::factory()->create();

        $this->assertTrue(strlen($promocodeInvite->code) === 9);

        $promocode = PromocodeValidateInvite::check($promocodeInvite->code);
        $this->assertNotNull($promocode);

        $this->expectException(InvalidCodeException::class);
        PromocodeValidateStripe::check($promocodeInvite->code);
    }
}
