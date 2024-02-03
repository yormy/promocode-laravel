<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Yormy\PromocodeLaravel\Models\BillingPromocodeStripe;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class DiscountCodeStoreTest extends BaseCodeStore
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.discounts.store';
    const ROUTE_UPDATE = 'api.v1.admin.promocodes.discounts.update';
    const ROUTE_DESTROY = 'api.v1.admin.promocodes.discounts.destroy';

    protected function getPostData()
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

            'stripe_coupon_id' => 'stripe_123123',
            'description_discount_percentage' => 10,
        ];

        return $data;
    }

    protected function factoryCreate(): BillingPromocodeStripe
    {
        return BillingPromocodeStripe::factory()->create();
    }

    protected function find(array $attributes): Collection
    {
        return BillingPromocodeStripe::where($attributes)->get();
    }
}
