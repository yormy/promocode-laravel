<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Tests\TestCase;

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
