<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Yormy\Apiresponse\Facades\ApiResponse;
use Yormy\PromocodeLaravel\DataObjects\InviteCodeData;
use Yormy\PromocodeLaravel\Http\Controllers\Resources\InviteCodeCollection;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Repositories\PromocodeInviteRepository;

class InviteCodeController
{
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $inviteCodes = (new InviteCodeCollection($inviteCodes))->toArray($request);


        return ApiResponse::withData($inviteCodes)->successResponse();
    }

    public function store(InviteCodeData $data)
    {

        $promocodeInviteRepository= new PromocodeInviteRepository();
        $new = $promocodeInviteRepository->create($data);

        $dto = InviteCodeData::fromModel($new)->asResource();

        return ApiResponse::withData($dto)->successResponse();
    }

}
