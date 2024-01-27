<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Tests\TestCase;

// Add new code cannot be duplicate, not in deleted either
// deletion is soft deleted
// date activated cannot be in the past
// date expired cannot be before activated
// update max uses cannot be lower than current uses
// auto create code
// update code
// update dataset
// test registration:
// -- new code added
// -- deleted code
// -- expired
// -- no uses left
// --
class InviteCodeTest extends TestCase
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
        PromocodeInvite::factory()->create(['code' => 'ABCDEF']);
        PromocodeInvite::factory()->create(['code' => '123456']);

        $response = $this->json('GET', route(static::ROUTE_INDEX));

        $response->assertSuccessful();
        $response->assertJsonDataArrayHasElement('code', 'ABCDEF');
        $response->assertJsonDataArrayHasElement('code', '123456');
    }

    /**
     * @test
     *
     * @group promocode-invite
     */
    public function InviteCodeAllUsed_Index_NoUsesLeft(): void
    {
        PromocodeInvite::factory()->create(['code' => 'ABCDEF', 'uses_current' => 1]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('usesLeft', 0);
        $response->assertJsonDataArrayHasElement('isActive', true);
        $response->assertJsonDataArrayHasElement('isAvailable', false);
    }

    /**
     * @test
     *
     * @group promocode-invite
     */
    public function InviteCodeNotActivated_Index_NotActivated(): void
    {
        PromocodeInvite::factory()->create(['code' => 'ABCDEF', 'active_from' => Carbon::now()->addDays(1)]);

        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        $response->assertJsonDataArrayHasElement('isActive', false);
        $response->assertJsonDataArrayHasElement('isAvailable', false);
    }
}
