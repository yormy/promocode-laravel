<?php

namespace Yormy\PromocodeLaravel\Tests\Feature;

use Illuminate\Support\Carbon;
use Yormy\AssertLaravel\Traits\RouteHelperTrait;
use Yormy\PromocodeLaravel\Models\PromocodeInvite;
use Yormy\PromocodeLaravel\Tests\TestCase;

// Add new code cannot be duplicate, not in deleted either
// deletion is soft deleted
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
class InviteCodeStoreTest extends BaseCodeStoreTest
{
    const ROUTE_STORE = 'api.v1.admin.promocodes.invites.store';

}
