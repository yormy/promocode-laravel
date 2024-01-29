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
 *
 * todo:
 * collection
 * paginated collection
 */
class InviteCodeController
{

    /**
     * Index
     * description
     *
     * @response 200
     * @ApiResponseDTOCollection Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @responseFieldDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     */
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $dto = InviteCodeData::collection($inviteCodes);

        return ApiResponse::withData($dto)->successResponse();
    }

    /**
     * Store
     * Description
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
     * @responseFieldDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @ApiResponseDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @ApiResponse successResponseCreated
     */
    public function store(InviteCodeData $data)
    {
        $promocodeInviteRepository= new PromocodeInviteRepository();
        $new = $promocodeInviteRepository->create($data);

        $dto = InviteCodeData::fromModel($new)->asResource();

        return ApiResponse::withData($dto)->successResponse();
    }

}
