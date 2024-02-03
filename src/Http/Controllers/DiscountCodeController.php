<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Yormy\Apiresponse\Facades\ApiResponse;
use Yormy\PromocodeLaravel\DataObjects\DiscountCode\DiscountCodeDataRequest;
use Yormy\PromocodeLaravel\DataObjects\DiscountCode\DiscountCodeDataResponse;
use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeDataRequest;
use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeDataResponse;
use Yormy\PromocodeLaravel\Models\DiscountCodeStripe;
use Yormy\PromocodeLaravel\Repositories\PromocodeDiscountRepository;

/**
 * @group Promocodes
 *
 * @subgroup Discounts
 * @subgroupDescription
 * Manage stripe discount codes
 */
class DiscountCodeController
{
    /**
     * Index
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse
     * @responseApiDTOCollection Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse paginate=5
     * @responseApiType successResponseCreated
     */
    public function index(Request $request)
    {
        $discountCodes = DiscountCodeStripe::all();

        $dto = DiscountCodeDataResponse::collection($discountCodes);

        return ApiResponse::withData($dto)->successResponse();
    }

    /**
     * Store
     *
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataRequest
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse
     * @responseApiType successResponseCreated
     */
    public function store(DiscountCodeDataRequest $data)
    {
        $promocodeDiscountRepository= new PromocodeDiscountRepository();
        $new = $promocodeDiscountRepository->create($data);

        $dto = InviteCodeDataResponse::fromModel($new);

        return ApiResponse::withData($dto)->successResponseCreated();
    }

    /**
     * Update
     *
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataRequest
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\Promocode\DiscountCodeDataResponse
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse
     * @responseApiType successResponseUpdated
     */
    public function update(DiscountCodeDataRequest $data, DiscountCodeStripe $code_xid)
    {
        $promocodeInvite = $code_xid;

        $promocodeDiscountRepository= new PromocodeDiscountRepository($promocodeInvite);
        $updated = $promocodeDiscountRepository->update($data);

        $dto = InviteCodeDataResponse::fromModel($updated);

        return ApiResponse::withData($dto)->successResponseUpdated();
    }

    /**
     * Destroy
     *
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\Promocode\DiscountCodeDataResponse
     * @responseApiType successResponseDeleted
     */
    public function destroy(DiscountCodeStripe $code_xid)
    {
        $code_xid->delete();

        return ApiResponse::withData($code_xid)->successResponseDeleted();
    }

}
