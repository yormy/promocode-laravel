<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Yormy\Apiresponse\Facades\ApiResponse;
use Yormy\PromocodeLaravel\Http\Controllers\Resources\InviteCodeCollection;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;

class InviteCodeController
{
    public function index(Request $request)
    {
        $inviteCodes = PromocodeInvite::all();
        $inviteCodes = (new InviteCodeCollection($inviteCodes))->toArray($request);


        return ApiResponse::withData($inviteCodes)->successResponse();
    }

}
