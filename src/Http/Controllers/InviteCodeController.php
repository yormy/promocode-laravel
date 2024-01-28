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

/**
 * @group Promocodes
 *  description here
 *
 * <small class="badge badge-green">badge</small>
 *
 * @subgroup Invite
 * @subgroupDescription
 * Subgroup Terms and Conditions: Add Update Activate
 *
 * <small class="badge badge-green">badge</small>
 *
 * @authenticated
 */
class InviteCodeController
{

    /**
     * Index
     *
     * @LaravelData Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @ApiResponse errorResponse
     * @ApiResponseErrorClass Mexion\BedrockUsersv2\Domain\User\DataObjects\Responses\Error
     * @ApiResponseErrorCode VALIDATION_ERROR
     */
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $inviteCodes = (new InviteCodeCollection($inviteCodes))->toArray($request);


        return ApiResponse::withData($inviteCodes)->successResponse();
    }

    //* bodyParam internal_name int required The room ID. Example: r98639bgh3

    /**
     * Store
     * Description
     * @bodyData internal_name Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @bodyData description Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     * @bodyData code Yormy\PromocodeLaravel\DataObjects\InviteCodeData
     *
     * @LaravelData Yormy\PromocodeLaravel\DataObjects\InviteCodeData
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
