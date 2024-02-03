<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\InviteCode;

trait UseInviteCodeExtention
{
    public static function rules(): array
    {
        $rules = parent::rules();

        $rules['code'] = ['unique:promocodes_invites,code', 'string', 'max:9'];

        return $rules;
    }
}
