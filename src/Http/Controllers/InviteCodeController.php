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
 * TODO:
 * 1) how to specify the apiresponse result
 * 2) Couldn't get example model for Mexion\BedrockUsersv2\Domain\Agreement\Models\UserTerm via factoryCreate.
 * 3) Create a DTO without activate being in there
 */

//* @apiResource Yormy\PromocodeLaravel\Http\Controllers\Resources\InviteCodeResource
//* @apiResourceModel Yormy\PromocodeLaravel\Models\PromocodeInvite
//
///**
// * @group Promocodes
// *  description here
// *
// * <small class="badge badge-green">badge</small>
// *
// * @subgroup Invite
// * @subgroupDescription
// * Subgroup Terms and Conditions: Add Update Activate
// *
// * <small class="badge badge-green">badge</small>
// *
// * @authenticated
// */
class InviteCodeController
{

    /**
     * Index
     *
     * @ApiResponse errorResponse
     * @ApiResponseDTO Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @ApiResponseErrorClass Mexion\BedrockUsersv2\Domain\User\DataObjects\Responses\Error
     * @ApiResponseErrorCode VALIDATION_ERROR
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
