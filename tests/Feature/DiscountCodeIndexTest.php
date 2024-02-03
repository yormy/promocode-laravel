<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\PromocodeLaravel\Tests\TestCase;

class DiscountCodeIndexTest extends TestCase
{
    use RouteHelperTrait;

    const ROUTE_INDEX = 'api.v1.admin.promocodes.discounts.index';

    /**
     * @test
     *
     * @group promocode-discount
     */
    public function DiscountCodeCode_Index_HasAll(): void
    {
        $code1 = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $code2 = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);

        DiscountCodeStripe::factory(5)->create();
        DiscountCodeStripe::factory()->create(['code' => $code1]);
        DiscountCodeStripe::factory()->create(['code' => $code2]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));

        $response->assertSuccessful();
        $response->assertJsonDataArrayHasElement('code', $code1);
        $response->assertJsonDataArrayHasElement('code', $code2);
    }

    /**
     * @test
     *
     * @group promocode-discount
     */
    public function DiscountCodeAllUsed_Index_NoUsesLeft(): void
    {
        DiscountCodeStripe::truncate();
        DiscountCodeStripe::factory()->create(['uses_current' => 1]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('uses_left', 0);
        $response->assertJsonDataArrayHasElement('is_active', true);
        $response->assertJsonDataArrayHasElement('is_available', false);
    }

    /**
     * @test
     *
     * @group promocode-discount
     */
    public function DiscountCodeNotActivated_Index_NotActivated(): void
    {
        DiscountCodeStripe::factory()->create(['active_from' => Carbon::now()->addDays(1)]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('is_active', false);
        $response->assertJsonDataArrayHasElement('is_available', false);
    }
}
