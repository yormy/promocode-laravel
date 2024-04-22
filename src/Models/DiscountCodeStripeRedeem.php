<?php

namespace Yormy\PromocodeLaravel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Yormy\CoreToolsLaravel\Traits\Factories\PackageFactoryTrait;
use Yormy\PromocodeLaravel\Models\Scopes\AvailableScope;
use Yormy\Xid\Models\Traits\Xid;

/**
 * Yormy\PromocodeLaravel\Models\DiscountCodeStripe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe active()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe available()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe forEmail(string $email)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe forIp(string $ip)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe forUser($user)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCodeStripe withoutTrashed()
 * @mixin \Eloquent
 */
class DiscountCodeStripeRedeem extends BaseModel
{
    use Xid;

    protected $table = 'billing_promocodes_stripe_redeem';

    protected $fillable = [
        'user_id',
        'user_type',
        'billing_promocode_stripe_id'
    ];
}
