<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\PromocodeLaravel\Tests\TestCase;

// Add new code cannot be duplicate, not in deleted either
// deletion is soft deleted
// missing fields
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
abstract class BaseCodeStore extends TestCase
{
    use RouteHelperTrait;

    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';
    const ROUTE_UPDATE = 'api.v1.admin.promocodes.invites.update';

    /**
     * @test
     *
     * @group promocode-invite
     * @group xxx
     *
     */
    public function InviteCode_Create_Success()
    {
        $code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $data = $this->getPostData();
        $data['code'] = $code;

        $response = $this->json('POST', route(static::ROUTE_STORE), $data);

        $response->assertCreated();
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

    /**
     * @test
     *
     * @group promocode-invite
     * @group xxx
     *
     */
    public function InviteCode_Update_Success()
    {
        $internalName = "Hello Test";

        $promocodeInvite = PromocodeInvite::factory()->create();

        $data = $this->getPostData();
        $data['internal_name'] = $internalName;
        $response = $this->json('POST', route(static::ROUTE_STORE, $promocodeInvite->xid), $data);

        $response->assertCreated();
        $response->assertJsonDataItemNotHasElement('xid', $data['xid']);
        $response->assertJsonDataItemHasElement('code', $data['code']);
        $response->assertJsonDataItemHasElement('uses_current', 0);
        $response->assertJsonDataItemHasElement('uses_left', $data['uses_max']);
        $response->assertJsonDataItemHasElement('is_available', true);
        $response->assertJsonDataItemHasElement('is_active', true);

        $response->assertJsonDataItemHasElement('internal_name', $internalName);
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
            'code'=> CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9),
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
