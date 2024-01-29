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
 * @authenticated
 */
class InviteCodeController
{

    /**
     * Index
     * ?????
     * Pagination ?
     * @ApiResponse successResponse
     */
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $inviteCodes = (new InviteCodeCollection($inviteCodes))->toArray($request);


        return ApiResponse::withData($inviteCodes)->successResponse();
    }

    /**
     * Store
     * Description
     * @bodyParamDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
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
