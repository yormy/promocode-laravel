<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Yormy\Apiresponse\Facades\ApiResponse;
use Yormy\PromocodeLaravel\DataObjects\InviteCodeDataRequest;
use Yormy\PromocodeLaravel\DataObjects\InviteCodeDataResponse;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Repositories\PromocodeInviteRepository;

/**
 * @group Promocodes
 *
 * @subgroup Invite
 * @subgroupDescription
 * Manage invite codes
 */
class InviteCodeController
{

    /**
     * Index
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiDTOCollection Yormy\PromocodeLaravel\DataObjects\InviteCodeData paginate=5
     * @responseApiType successResponseCreated
     */
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();

        $dto = InviteCodeDataResponse::collection($inviteCodes);

        return ApiResponse::withData($dto)->successResponse();
    }

    /**
     * Store
     *
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiType successResponseCreated
     */
    public function store(InviteCodeDataRequest $data)
    {
        $promocodeInviteRepository= new PromocodeInviteRepository();
        $new = $promocodeInviteRepository->create($data);

        $dto = InviteCodeDataResponse::fromModel($new);

        return ApiResponse::withData($dto)->successResponseCreated();
    }

    /**
     * Update
     *
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
     * @responseFieldsDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiType successResponseUpdated
     */
    public function update(InviteCodeDataRequest $data, PromocodeInvite $code_xid)
    {
        $promocodeInvite = $code_xid;

        $promocodeInviteRepository= new PromocodeInviteRepository($promocodeInvite);
        $updated = $promocodeInviteRepository->update($data);

        $dto = InviteCodeDataResponse::fromModel($updated);

        return ApiResponse::withData($dto)->successResponseUpdated();
    }

    /**
     * Destroy
     *
     * @responseApiDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiType successResponseDeleted
     */
    public function destroy(PromocodeInvite $code_xid)
    {
        $code_xid->delete();

        return ApiResponse::withData($code_xid)->successResponseDeleted();
    }

}
