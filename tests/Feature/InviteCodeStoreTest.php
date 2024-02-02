<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Tests\TestCase;

// date activated cannot be in the past
// date expired cannot be before activated
// update max uses cannot be lower than current uses
// update code
// update dataset
// test registration:
// -- new code added
// -- deleted code
// -- expired
// -- no uses left
// --
class InviteCodeStoreTest extends BaseCodeStore
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';
    const ROUTE_UPDATE = 'api.v1.admin.promocodes.invites.update';
    const ROUTE_DESTROY = 'api.v1.admin.promocodes.invites.destroy';
}
