<?php

namespace Yormy\PromocodeLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Mexion\BedrockUsersv2\Domain\Billing\Repositories\BillingPlanRepository;
use Mexion\BedrockUsersv2\Domain\Billing\Resources\BillingPlanCollection;
use Mexion\BedrockUsersv2\Domain\User\Services\Resolvers\UserResolver;
use Yormy\Apiresponse\Facades\ApiResponse;

class InviteCodeController
{
    public function index(Request $request)
    {
//        $billingPlanRepository = new BillingPlanRepository();
//        $activeMonthly = $billingPlanRepository->getAllActiveYearly();
//
//        $currentSubscription = $this->getCurrentSubscription();
//        $yearlyPlans = (new BillingPlanCollection($activeMonthly, $currentSubscription))->toArray($request);

        return ApiResponse::withData([])->successResponse();
    }

}
