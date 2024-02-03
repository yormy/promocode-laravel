<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
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

        BillingPromocodeStripe::factory(5)->create();
        BillingPromocodeStripe::factory()->create(['code' => $code1]);
        BillingPromocodeStripe::factory()->create(['code' => $code2]);

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
        BillingPromocodeStripe::truncate();
        BillingPromocodeStripe::factory()->create(['uses_current' => 1]);

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
        BillingPromocodeStripe::factory()->create(['active_from' => Carbon::now()->addDays(1)]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('is_active', false);
        $response->assertJsonDataArrayHasElement('is_available', false);
    }
}
