<?php

namespace Yormy\PromocodeLaravel\Tests\Unit;

use Illuminate\Support\Str;
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
        $promocodeStripe = BillingPromocodeStripe::factory()->create();

        $this->assertTrue(strlen($promocodeStripe->code) === 9);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function CreateSpecifiedCode(): void
    {
        $codeValue = Str::random(10);
        $promocodeStripe = BillingPromocodeStripe::factory()->code($codeValue)->create();

        $this->assertTrue($promocodeStripe->code === $codeValue);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function Create_WitDiscountPercentage(): void
    {
        $promocodeStripe = BillingPromocodeStripe::factory()->discountPercentage(10)->create([
                'internal_name' => 'Some Internal Name',
                'description' => 'Some description',
            ]
        );

        $this->assertTrue(strlen($promocodeStripe->code) === 9);
    }

    /**
     * @test
     *
     * @group create-code
     */
    public function Create_WitDiscountAmount(): void
    {
        $promocodeStripe = BillingPromocodeStripe::factory()->discountAmount(10)->create([
                'internal_name' => 'Some Internal Name',
                'description' => 'Some description',
            ]
        );

        $this->assertTrue(strlen($promocodeStripe->code) === 9);
    }
}
