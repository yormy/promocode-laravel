<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Yormy\AssertLaravel\Traits\RouteHelperTrait;
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
     * @group xxx
     */
    public function TestTest(): void
    {
        $response = $this->json('GET', route(static::ROUTE_INDEX));
        $response->assertSuccessful();

        dd($response->getContent());
    }

}
