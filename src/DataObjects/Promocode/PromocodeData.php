<?php declare(strict_types=1);

namespace Yormy\PromocodeLaravel\DataObjects\Promocode;

use Spatie\LaravelData\Data;

abstract class PromocodeData extends Data
{
    public static function rules(): array
    {
        $rules['internal_name'] = ['required', 'string', 'max:100'];
        $rules['description'] = ['required', 'string', 'max:100'];

        $rules['uses_max'] = ['required', 'integer', 'min:0','max:10000'];
        $rules['active_from'] = ['required', 'date'];
        $rules['expires_at'] = ['required', 'date', 'after:active_from'];

        $rules['for_user_id'] = ['sometimes', 'nullable'];
        $rules['for_ip'] = ['sometimes', 'nullable', 'string', 'max:100'];
        $rules['for_email'] = ['sometimes', 'nullable', 'string', 'email'];

        return $rules;
    }

    public static function examples(): array
    {
        $data['internal_name'] = 'Christmas Bonus';
        $data['description'] = 'Special 2024 christmas bonus';
        $data['code'] = '1WQWERTR4';
        $data['uses_max'] = '10';
        $data['active_from'] = '20224-12-20 00:00:00';
        $data['expires_at'] = '20224-12-31 00:00:00';
        $data['for_ip'] = '198.12.13.100';
        $data['for_email'] = 'welcome@example.com';

        $data['xid'] = '123123!24';
        $data['uses_current'] = '2';
        $data['uses_left'] = '8';
        $data['is_active'] = true;
        $data['is_available'] = true;
        $data['deleted_at'] = null;

        return $data;
    }

    public static function descriptions(): array
    {
        $data['internal_name'] = 'Internal name';
        $data['description'] = '';
        $data['code'] = 'The actual invite code';
        $data['uses_max'] = 'How many times it can be used';
        $data['active_from'] = '';
        $data['expires_at'] = '';
        $data['for_ip'] = 'Only allowed for this ip address';
        $data['for_email'] = 'Only allowed for this email address';

        $data['xid'] = 'Internal id';
        $data['uses_current'] = 'Current number of usages';
        $data['uses_left'] = 'Usages left';
        $data['is_active'] = 'Is active based on date';
        $data['is_available'] = 'Is available, can be used, active and usages left';
        $data['deleted_at'] = '';

        return $data;
    }
}
