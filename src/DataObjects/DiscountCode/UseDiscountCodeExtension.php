<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

trait UseDiscountCodeExtension
{
    public static function rules(): array
    {
        $rules = parent::rules();
        $rules['code'] = ['unique:billing_promocodes_stripe,code', 'string', 'max:10'];

        $rules['description_discount_amount_cents'] = [
            'required_without:description_discount_percentage',
            'missing_with:description_discount_percentage',
            'integer',
            'max:100'
        ];
        $rules['description_discount_percentage'] = [
            'required_without:description_discount_amount_cents',
            'missing_with:description_discount_amount_cents',
            'integer',
            'max:100'
        ];
        $rules['stripe_coupon_id'] = ['required', 'string', 'max:100'];

        return $rules;
    }

    public static function examples(): array
    {
        $examples = parent::examples();

        $examples['description_discount_amount_cents'] = null;
        $examples['description_discount_percentage'] = 10;
        $examples['stripe_coupon_id'] = 'stripe_id_12341234';

        return $examples;
    }

    public static function descriptions(): array
    {
        $descriptions = parent::descriptions();

        $descriptions['description_discount_amount_cents'] = 'The amount of discount (cannot be set when percentage is set)';
        $descriptions['description_discount_percentage'] = 'The percentage of discount (cannot be set when amount is set)';
        $descriptions['stripe_coupon_id'] = 'The actual stripe coupon code from your stripe backend';

        return $descriptions;
    }
}
