<?php

namespace Yormy\PromocodeLaravel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Yormy\CoreToolsLaravel\Traits\Factories\PackageFactoryTrait;
use Yormy\PromocodeLaravel\Models\Scopes\AvailableScope;
use Yormy\Xid\Models\Traits\Xid;

/**
 * Yormy\PromocodeLaravel\Models\PromocodeInvite
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite active()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite available()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite forEmail(string $email)
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite forIp(string $ip)
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite forUser($user)
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PromocodeInvite withoutTrashed()
 * @mixin \Eloquent
 */
class PromocodeInvite extends BaseModel
{
    use AvailableScope;
    use SoftDeletes;
    use PackageFactoryTrait;
    use Xid;

    protected $table = 'promocode_invite';

    protected $fillable = [
        'internal_name',
        'code',
        'description',

        'active_from',
        'expires_at',
        'max_uses',

        'for_user_id',
        'for_user_type',
        'for_email',
        'for_ip',
    ];
}
