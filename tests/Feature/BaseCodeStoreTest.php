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
// update code
// update dataset
// test registration:
// -- new code added
// -- deleted code
// -- expired
// -- no uses left
// --
class BaseCodeStoreTest extends TestCase
{
    use RouteHelperTrait;

    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';

    /**
     * @test
     *
     * @group xxx
     */
    public function InviteCode_Create_Success()
    {
        $code = '654543';
        $data = $this->getPostData();
        //unset($data['code']);
        $data['code'] = $code;

        $response = $this->json('POST', route(static::ROUTE_STORE, $data));

        $response->assertSuccessful();
        $response->assertJsonDataItemNotHasElement('xid', $data['xid']);
        $response->assertJsonDataItemHasElement('code', $code);
        $response->assertJsonDataItemHasElement('uses_current', 0);
        $response->assertJsonDataItemHasElement('uses_left', $data['uses_max']);
        $response->assertJsonDataItemHasElement('is_available', true);
        $response->assertJsonDataItemHasElement('is_active', true);

        $response->assertJsonDataItemHasElement('internal_name', $data['internal_name']);
        $response->assertJsonDataItemHasElement('for_user_id', $data['for_user_id']);
        $response->assertJsonDataItemHasElement('for_ip', $data['for_ip']);
        $response->assertJsonDataItemHasElement('for_email', $data['for_email']);
        $response->assertJsonDataItemHasElement('active_from', $data['active_from']);
        $response->assertJsonDataItemHasElement('expires_at', $data['expires_at']);

        return $response;
    }

    // ---------- HELPERS ----------
    private function getPostData()
    {
        $data = [
            'xid' => '1111',
            'internal_name' => 'Christmas bonus',
            'description' => 'description',
            'code'=> 'WWWW11',
            'uses_max'=> 10,
            'uses_current'=> 2,
            'uses_left'=> 1,
            'for_user_id'=> 1,
            'for_ip'=> '127.0.0.1',
            'for_email'=> 'example@example.com',
            'active_from'=> '2020-01-01 10:10:10',
            'expires_at'=> '2026-12-12 10:10:10',
        ];

        return $data;
    }

}
