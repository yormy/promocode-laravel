<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\PromocodeLaravel\Tests\TestCase;

class InviteCodeIndexTest extends TestCase
{
    use RouteHelperTrait;

    const ROUTE_INDEX = 'api.v1.admin.promocodes.invites.index';

    /**
     * @test
     *
     * @group promocode-invite
     */
    public function InviteCode_Index_HasAll(): void
    {
        $code1 = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $code2 = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);

        PromocodeInvite::factory(5)->create();
        PromocodeInvite::factory()->create(['code' => $code1]);
        PromocodeInvite::factory()->create(['code' => $code2]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));

        $response->assertSuccessful();
        $response->assertJsonDataArrayHasElement('code', $code1);
        $response->assertJsonDataArrayHasElement('code', $code2);
    }

    /**
     * @test
     *
     * @group promocode-invite
     */
    public function InviteCodeAllUsed_Index_NoUsesLeft(): void
    {
        PromocodeInvite::truncate();
        PromocodeInvite::factory()->create(['uses_current' => 1]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('uses_left', 0);
        $response->assertJsonDataArrayHasElement('is_active', true);
        $response->assertJsonDataArrayHasElement('is_available', false);
    }

    /**
     * @test
     *
     * @group promocode-invite
     */
    public function InviteCodeNotActivated_Index_NotActivated(): void
    {
        PromocodeInvite::factory()->create(['active_from' => Carbon::now()->addDays(1)]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('is_active', false);
        $response->assertJsonDataArrayHasElement('is_available', false);
    }
}
