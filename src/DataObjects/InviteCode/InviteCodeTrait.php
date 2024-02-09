<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\InviteCode;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Support\Validation\ValidationContext;

trait InviteCodeTrait
{
    public static function rules(ValidationContext $context): array
    {
        $rules = parent::rules($context);

        $currentXid = collect($context->payload)->get('xid');

        $rules['code'] = ['sometimes', 'string', 'max:10', Rule::unique('billing_promocodes_stripe')->ignore($currentXid, 'xid')];

        return $rules;
    }
}
