<?php

namespace Yormy\PromocodeLaravel\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Yormy\CoreToolsLaravel\Traits\Factories\PackageFactoryTrait;
use Yormy\PromocodeLaravel\Models\Scopes\AvailableScope;
use Yormy\PromocodeLaravel\Services\CodeGenerator;
use Yormy\Xid\Models\Traits\Xid;

abstract class InviteCode extends BaseModel
{
    use AvailableScope;
    use SoftDeletes;
    use PackageFactoryTrait;
    use Xid;

    protected $table = 'promocodes_invites';

    protected $appends = [
        'is_active',
        'is_available',
        'uses_left',
    ];

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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_available' => 'boolean',
        'active_from' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public static function generate(): string
    {
        $length = config('promocode.invite.length');
        $type = config('promocode.invite.type');

        return CodeGenerator::generate($type, $length);
    }

    public function getUsesLeftAttribute() : int
    {
        return max($this->uses_max - $this->uses_current, 0);
    }

    public function getIsActiveAttribute() : int
    {
        return $this->active_from <= Carbon::now() && ( $this->expires_at > Carbon::now() || $this->expires_at === null);
    }

    public function getIsAvailableAttribute() : int
    {
        return $this->is_active && $this->uses_left > 0 ;
    }

    public function getRouteKeyName()
    {
        return 'xid';
    }
}
