<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\InviteCode;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Support\Validation\ValidationContext;

trait InviteCodeTrait
{
    public static function rules(ValidationContext $context): array
    {
        $rules = parent::rules($context);

        $rules['code'] = ['required', 'string', 'max:10', Rule::unique('promocodes_invites')->ignore($context->payload['xid'], 'xid')];

        return $rules;
    }
}
