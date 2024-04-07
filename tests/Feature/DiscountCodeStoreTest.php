<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Services\CodeGenerator;

class DiscountCodeStoreTest extends BaseCodeStore
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.discounts.store';

    const ROUTE_UPDATE = 'api.v1.admin.promocodes.discounts.update';

    const ROUTE_DESTROY = 'api.v1.admin.promocodes.discounts.destroy';

    /**
     * @test
     *
     * @group promocode
     * @group xxx
     */
    public function DiscountCode_Store_RequiredFieldsPresent()
    {
        $this->withExceptionHandling();
        $data = $this->getPostData();

        unset($data['description_discount_percentage']);
        unset($data['description_discount_amount']);

        $new = $data;
        $response = $this->json('POST', route(static::ROUTE_STORE), $new);
        $response->assertJsonValidationErrorFor('description_discount_percentage');

        $new = $data;
        $new['description_discount_percentage'] = 10;
        $new['description_discount_amount_cents'] = 10;
        $response = $this->json('POST', route(static::ROUTE_STORE), $new);
        $response->assertJsonValidationErrorFor('description_discount_amount_cents');
        $response->assertJsonValidationErrorFor('description_discount_percentage');

        $new = $data;
        $new['description_discount_percentage'] = 10;
        $response = $this->json('POST', route(static::ROUTE_STORE), $new);
        $response->assertSuccessful();
    }

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

            'stripe_coupon_id' => 'stripe_123123',
            'description_discount_percentage' => 10,
        ];

        return $data;
    }

    protected function factoryCreate(): DiscountCodeStripe
    {
        return DiscountCodeStripe::factory()->create();
    }

    protected function find(array $attributes): Collection
    {
        return DiscountCodeStripe::where($attributes)->get();
    }
}
