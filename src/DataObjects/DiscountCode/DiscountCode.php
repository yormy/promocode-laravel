<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Yormy\PromocodeLaravel\DataObjects\InviteCode\InviteCodeData;

abstract class DiscountCode extends InviteCodeData
{
    public static function rules(): array
    {
        $rules = parent::rules();

        $rules['description_discount_amount'] = ['required', 'string', 'max:100'];
        $rules['description_discount_percentage'] = ['required', 'string', 'max:100'];
        $rules['stripe_coupon_id'] = ['required', 'string', 'max:100'];

        return $rules;
    }

    public static function examples(): array
    {
        $examples = parent::examples();

        $examples['description_discount_amount'] = null;
        $examples['description_discount_percentage'] = 10;
        $examples['stripe_coupon_id'] = 'stripe_id_12341234';

        return $examples;
    }

    public static function descriptions(): array
    {
        $descriptions = parent::descriptions();

        $descriptions['description_discount_amount'] = 'The amount of discount (cannot be set when percentage is set)';
        $descriptions['description_discount_percentage'] = 'The percentage of discount (cannot be set when amount is set)';
        $descriptions['stripe_coupon_id'] = 'The actual stripe coupon code from your stripe backend';

        return $descriptions;
    }
}
