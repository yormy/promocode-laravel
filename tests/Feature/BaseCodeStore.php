<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\PromocodeLaravel\Tests\TestCase;

abstract class BaseCodeStore extends TestCase
{
    use RouteHelperTrait;

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_Store_RequiredFieldsPresent()
    {
        $requiredFields = [
            'internal_name',
            'expires_at',
            'active_from',
            'uses_max',
        ];
        $this->withExceptionHandling();
        $data = $this->getPostData();

        foreach ($requiredFields as $field) {
            $removed = $data;
            unset($removed[$field]);

            $response = $this->json('POST', route(static::ROUTE_STORE), $removed);
            $response->assertJsonValidationErrorFor($field);
        }
    }

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_Create_Success()
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
     * @group promocode
     */
    public function Code_Update_Success()
    {
        $internalName = 'Hello Test';

        $promocode = $this->factoryCreate();

        $data = $this->getPostData();
        $data['internal_name'] = $internalName;
        $response = $this->json('PUT', route(static::ROUTE_UPDATE, $promocode->xid), $data);

        $response->assertSuccessful();
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

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_Delete_Success()
    {
        $promocode = $this->factoryCreate();

        $response = $this->json('DELETE', route(static::ROUTE_DESTROY, $promocode->xid));
        $response->assertSuccessful();

        $models = $this->find(['xid' => $promocode->xid]);

        $this->assertTrue($models->isEmpty());
    }

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_CreateDuplicate_Failed()
    {
        $code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $data = $this->getPostData();
        $data['code'] = $code;

        $this->withExceptionHandling();
        $this->json('POST', route(static::ROUTE_STORE), $data);
        $response = $this->json('POST', route(static::ROUTE_STORE), $data);

        $response->assertJsonValidationErrorFor('code');
    }

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_CreateDuplicateTrashed_Failed()
    {
        $code = CodeGenerator::generate(CodeGenerator::TYPE_NUMERIC_ALPHA_UPPERCASE, 9);
        $data = $this->getPostData();
        $data['code'] = $code;

        $this->withExceptionHandling();
        $this->json('POST', route(static::ROUTE_STORE), $data);

        $models = $this->find(['code' => $code]);
        $models->first()->delete();

        $response = $this->json('POST', route(static::ROUTE_STORE), $data);
        $response->assertJsonValidationErrorFor('code');
    }

    /**
     * @test
     *
     * @group promocode
     */
    public function Code_ExpiresAfterActiveFrom()
    {
        $data = $this->getPostData();
        $data['active_from'] = Carbon::now();
        $data['expires_at'] = Carbon::now()->subDay();

        $this->withExceptionHandling();
        $response = $this->json('POST', route(static::ROUTE_STORE), $data);
        $response->assertJsonValidationErrorFor('expires_at');
    }
}
