<?php

namespace Yormy\PromocodeLaravel\Database\Factories;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\Xid\Services\XidService;

class PromocodeInviteFactory extends PromocodeFactory
{
    protected $model = PromocodeInvite::class;
}
