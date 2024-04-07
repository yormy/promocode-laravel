<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class InviteCodeStoreTest extends BaseCodeStore
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';

    const ROUTE_UPDATE = 'api.v1.admin.promocodes.invites.update';

    const ROUTE_DESTROY = 'api.v1.admin.promocodes.invites.destroy';

    protected function getPostData()
    {
        $data = [
            'xid' => '1111',
            'internal_name' => 'Christmas bonus',
            'description' => 'description',
            'code' => CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9),
            'uses_max' => 10,
            'uses_current' => 2,
            'uses_left' => 1,
            'for_user_id' => 1,
            'for_ip' => '127.0.0.1',
            'for_email' => 'example@example.com',
            'active_from' => '2020-01-01 10:10:10',
            'expires_at' => '2026-12-12 10:10:10',
        ];

        return $data;
    }

    protected function factoryCreate(): PromocodeInvite
    {
        return PromocodeInvite::factory()->create();
    }

    protected function find(array $attributes): Collection
    {
        return PromocodeInvite::where($attributes)->get();
    }
}
