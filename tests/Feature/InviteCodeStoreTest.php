<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Tests\TestCase;

class InviteCodeStoreTest extends BaseCodeStore
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';
    const ROUTE_UPDATE = 'api.v1.admin.promocodes.invites.update';
    const ROUTE_DESTROY = 'api.v1.admin.promocodes.invites.destroy';
}
