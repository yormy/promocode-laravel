<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Mexion\BedrockUsersv2\Domain\User\DataObjects\Responses\Registration;
use Yormy\Apiresponse\Facades\ApiResponse;
use Yormy\PromocodeLaravel\DataObjects\InviteCodeData;
use Yormy\PromocodeLaravel\Http\Controllers\Resources\InviteCodeCollection;
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
     * @responseFieldDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
     * @responseApiDTOCollection Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseApiType successResponseCreated
     */
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $dto = InviteCodeData::collection($inviteCodes);

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
    public function store(InviteCodeData $data)
    {
        $promocodeInviteRepository= new PromocodeInviteRepository();
        $new = $promocodeInviteRepository->create($data);

        $dto = InviteCodeData::fromModel($new)->asResource();

        return ApiResponse::withData($dto)->successResponse();
    }

}
