<?php

namespace Yormy\PromocodeLaravel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Yormy\CoreToolsLaravel\Traits\Factories\PackageFactoryTrait;
use Yormy\PromocodeLaravel\Models\Scopes\AvailableScope;
use Yormy\Xid\Models\Traits\Xid;

/**
 * Yormy\PromocodeLaravel\Models\BillingPromocodeStripe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe active()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe available()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe forEmail(string $email)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe forIp(string $ip)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe forUser($user)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingPromocodeStripe withoutTrashed()
 * @mixin \Eloquent
 */
class BillingPromocodeStripe extends BaseModel
{
    use AvailableScope;
    use SoftDeletes;
    use Xid;
    use PackageFactoryTrait;

    protected $table = 'billing_promocodes_stripe';

    protected $fillable = [
        'internal_name',
        'code',
        'description',

        'active_from',
        'expires_at',
        'uses_max',

        'for_user_id',
        'for_user_type',
        'for_email',
        'for_ip',

        'description_discount_percentage',
        'description_discount_amount_cents',
        'stripe_coupon_id',

    ];
}
