<?php

declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\DiscountCode;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Support\Validation\ValidationContext;

trait DiscountCodeTrait
{
    public static function prepareForPipeline(array $properties): array
    {
        if ($properties->get('description_discount_percentage') == null) {
            unset($properties['description_discount_percentage']);
        }

        if ($properties->get('description_discount_amount_cents') == null) {
            unset($properties['description_discount_amount_cents']);
        }

        return $properties;
    }

    public static function rules(ValidationContext $context): array
    {
        $rules = parent::rules($context);

        $currentXid = collect($context->payload)->get('xid');

        $rules['code'] = ['sometimes', 'string', 'max:10', Rule::unique('billing_promocodes_stripe')->ignore($currentXid, 'xid')];

        $rules['description_discount_amount_cents'] = [
            'required_without:description_discount_percentage',
            'missing_with:description_discount_percentage',
            'integer',
            'max:100',
        ];
        $rules['description_discount_percentage'] = [
            'required_without:description_discount_amount_cents',
            'missing_with:description_discount_amount_cents',
            'integer',
            'max:100',
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
