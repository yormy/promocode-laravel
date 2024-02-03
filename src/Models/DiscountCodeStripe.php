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
class DiscountCodeStripe extends InviteCode
{
    protected $table = 'billing_promocodes_stripe';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $fillables = [
            'description_discount_percentage',
            'description_discount_amount_cents',
            'stripe_coupon_id',
        ];

        $this->fillable = array_merge($this->fillable, $fillables);
    }
}
